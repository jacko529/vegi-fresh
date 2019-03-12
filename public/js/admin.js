/**
 *
 * @param url
 * @returns {string} which is the whole url - example is http://localhost:81/foodAssignment/public/
 */
function getUrl(url) {
    var getUrl = window.location;
    var baseUrll = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/public';
    return baseUrll.concat(url);
}

/**
 * section to load each of the functions required
 */
$(document).ready(function () {
    load_popularIngredient();
    load_recipes();
    load_codeCurrentRecipes();
    /**
     *
     * this is out of place as it renders in the updateAndDelete page but
     * it is to display the most popular ingredient in the dashboard
     */
    function load_popularIngredient() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: getUrl('/updateAndDelete/Popular'),
            method: "POST",

            success: function (response) {
                $.each(response, function (i, value) {
                    $('#popular').append($('<strong>').text(value.ingredientName));
                    $('#month').append($('<strong>').text('in ' + value.month));
                    $('#ordered').append($('<strong>').text('By ' + value.number_of_times));

                });
            },
            error: function (response) {
                alert('Ooops something went wrong!');
            }

        });

    }



    /**
     *
     *
     * This is the function to show all codes for the next four weeks and how many
     *
     */
    function load_recipes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: getUrl('/admin/codeFourWeeks'),
            method: "POST",

            success: function (response) {

                $.each(response.code, function (i, value) {

                    $('<div>')
                        .attr('class', 's12 m2 center-align')
                        .attr('id', 'fourWeeks')

                        .append(
                            $('<strong>')
                                .attr('class', 'center-align')
                                .attr('class', 'ModelCode')
                                .text('Code is : ' + value.code))
                        .append(
                            $('<br>'))
                        .append(
                            $('<strong>')
                                .text('Date of week: - ' + value.code_allowed))
                        .append(
                            $('<br>'))
                        .append(
                            $('<strong>')
                                .text("Amount of recipes currently: " + value.amount))
                        .append(
                            $('<div>')
                                .attr('class', 'recipe-code')

                        )
                        .append(
                            $('<hr>')

                        )
                        .appendTo('#codes'); // add to image body


                });
                $.each(response.recipes, function (i, value) {
                        console.log(value);

                        $('<ul>')
                            .attr('class', 'center-align')
                            .attr('id', 'fourWeeks')

                            .append(
                                $('<li>')
                                    .attr('class', 'center-align')
                                    .append(
                                        $('<a>')
                                            .attr('href', getUrl('/updateAndDelete/')+value.recipe_id)
                                            .attr('class', 'center-align')
                                            .text( value.recipe_name)

                                    ))

                            // add link to edit a recipe
                            .appendTo('.recipe-code'); // add to image body
                });


                    },
            error: function (response) {
                alert('Ooops something went wrong!');
            }

        });
    }

    /**
     * triggering the materialize modal
     */
    $('.modal').modal();

    /**
     *
     * This function just shows the current week code and how many recipes are currently assigned
     */
    function load_codeCurrentRecipes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: getUrl('/admin/codeStartWeek'),
            method: "POST",

            success: function (response) {
                $.each(response.code, function (i, value) {
                    console.log(value);
                        $('<div>')
                            .attr('class', 'col s12 m12 center-align')
                            .text('This weeks code is ' + value.code)
                        .append(
                            $('<br>')
                        )
                        .append(
                            $('<strong>')
                                .attr('class', 'right-align')
                                .text('This weeks code date: ' + value.code_allowed))
                        .append(
                            $('<br>')
                        )
                        .append(
                            $('<strong>')
                                .text('The amount of recipes currently: ' + value.amount))

                        .appendTo('.codeback'); // add to image body


                });

                $.each(response.recipes, function (i, value) {
                    console.log(value);

                    $('<ul>')
                        .attr('class', 'center-align')
                        .attr('id', 'fourWeeks')

                        .append(
                            $('<li>')
                                .attr('class', 'center-align')
                                .append(
                                    $('<a>')
                                        .attr('href', getUrl('/updateAndDelete/')+value.recipe_id)
                                        .attr('class', 'center-align')
                                        .text( value.recipe_name)

                                ))

                                // add link to edit a recipe
                        .appendTo('.codeback'); // add to image body


                });
            },
            error: function (response) {
                alert('Ooops something went wrong!');
            }

        });
    }
});
