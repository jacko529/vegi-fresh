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

$(document).ready(function () {
    welcomeCategories();
    showWeekCode();
    $('.modal').modal();

    /**
     *
     *
     * code selector carousel function
     */
    jQuery('#BringUpSection').click(function (e) {
        e.preventDefault();
        var numberIncrement = 1;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/welcome/codeSelect'),
            method: 'post',
            data: {
                code: jQuery('#icon_prefix').val(),
            },
            success: function (result) {
                $('.carousel').empty();

                $.each(result, function (index) {

                    $('<a>') // create anchor first
                        .attr('class', 'carousel-item')
                        .attr('href', getUrl('/individualRecipe') + '/' + result[index].recipe_id)
                        .append( // inside it, append an image
                            $('<p>') // new image
                                .attr('class', 'black-text')
                                .text('Day ')
                        )
                        .append( // inside it, append an image
                            $('<p>') // new image
                                .attr('class', 'black-text')
                                .text(parseInt(numberIncrement++))
                        )
                        .append( // inside it, append an image

                            $('<p>') // new image
                                .attr('class', 'black-text')
                                .text(
                                    result[index].recipe_name)
                        )
                        .append( // inside it, append an image
                            $('<img>') // new image
                                .attr('src', getUrl('/storage') + '/' + result[index].picture_location) // set image SRC attribute
                        ) // end append
                        .appendTo('.carousel'); // add to image body

                    $('.carousel').carousel();
                });
                console.log(result);
            },
            error: function (result) {
                alert('Ooops something went wrong!');
            }

        });
    });

    /**
     * allow for select
     */
    $('select').formSelect();
    


    /**
     *
     * on change for vegi dishes
     */
    $('select').on('change', function () {
        if ( $('.select-vegi option:selected').attr('id') == '1' ) {
            $('.pictureDisplay').empty();
            welcomeCategoriesVegi();
        }
        else if ( $('.select-vegi option:selected').attr('id') == '0' ) {
            $('.pictureDisplay').empty();
            welcomeCategories();
        }
    });


    /**
     *
     * not sure completely what this one does
     */
    $("#clickme").click(function () {
        $("#book").toggle("slow", function () {
            // Animation complete.
        });
    });

    /**
     * pop up for code section
     *
     * the outer box this is
     */
    $(function () {
        $('#BridngUpSection').click(function () {
            $('#contactFormCat').fadeToggle();
        });

        $(document).mouseup(function (e) {
            var container = $("#contactFormCat");

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                container.fadeOut();
            }
        });
    });

    /***
     * ajax auto complete - key up and will query ingredients table
     * return data to id tag countryList
     */
    $('#country_name').keyup(function () {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: getUrl('/autocomplete/fetch'),
                method: "POST",
                data: {query: query, _token: _token},
                success: function (data) {
                    $('#countryList').fadeIn();
                    $('#countryList').html(data);
                }
            });
        }
    });

    $(document).on('click', '.listingRecipes', function () {
        $('#country_name').val($(this).text());
        $('#countryList').fadeOut();
    });


    /**
     * method show the key section of recipe catalog
     *
     *
     */
    function welcomeCategories() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/welcomeCategories'),
            method: 'get',
            data: {},
            beforeSend: function() {
                $('.progress').show();

            },
            success: function (result) {
                $('.progress').hide();

                $.each(result, function (categoryName, obj) {
                    // $('.pictureDisplay').append('<h3 class="categoryNameSee">'+categoryName+'</h3>');

                    var pictureTime = '  <ul class="collapsible"><li>    <div class="collapsible-header "><i class="material-icons">restaurant_menu</i>' + categoryName + '</div>';
                    pictureTime += '<div class="collapsible-body"><div class="row">';
                    $.each(obj, function (recipe_name, value) {
                        $.each(value, function (picture_location, recipeid) {
                            pictureTime += '<div class="col s4 card-panel hoverable" >';
                            pictureTime += '<a class="-material grabPic" href="' + getUrl('/individualRecipe') + '/' + recipeid + '">';
                            pictureTime += '<div>' + recipe_name + '</div>';
                            pictureTime += '<img height="100px" width="100px"' + 'src="' + getUrl('/storage') + '/' + picture_location + '"';
                            pictureTime += ' </a>';
                            pictureTime += '</div>';
                        });
                    });
                    pictureTime += '</div></div></li></ul>';
                    $(".pictureDisplay").append(pictureTime);

                });


                $('.collapsible').collapsible();

            }
        });
    }

    /*
    **
    * method show the key section of recipe catalog
        *
        *
        */
    function welcomeCategoriesVegi() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/welcomeCategoriesVegi'),
            method: 'get',
            data: {},
            beforeSend: function() {
                $('.progress').show();

            },
            success: function (result) {
                $('.progress').hide();

                $.each(result, function (categoryName, obj) {
                    // $('.pictureDisplay').append('<h3 class="categoryNameSee">'+categoryName+'</h3>');

                    var pictureTime = '  <ul class="collapsible"><li>    <div class="collapsible-header "><i class="material-icons">restaurant_menu</i>' + categoryName + '</div>';
                    pictureTime += '<div class="collapsible-body"><div class="row">';
                    $.each(obj, function (recipe_name, value) {
                        $.each(value, function (picture_location, recipeid) {
                            pictureTime += '<div class="col s4 card-panel hoverable" >';
                            pictureTime += '<a class="-material grabPic" href="' + getUrl('/individualRecipe') + '/' + recipeid + '">';
                            pictureTime += '<div>' + recipe_name + '</div>';
                            pictureTime += '<img height="100px" width="100px"' + 'src="' + getUrl('/storage') + '/' + picture_location + '"';
                            pictureTime += ' </a>';
                            pictureTime += '</div>';
                        });
                    });
                    pictureTime += '</div></div></li></ul>';
                    $(".pictureDisplay").append(pictureTime);

                });


                $('.collapsible').collapsible();

            }
        });
    }

  

    /**
     * show this weeks code
     *
     *
     */
    function showWeekCode() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/showCode'),
            method: 'post',
            success: function (data) {
                $.each(data, function (index, code) {
                $('#this-weeks-code').append('This weeks code is '+ code.code+' type it in the box and see what delicious recipes there are this week.');

                //   $('#this-weeks-code').html(data);
                });


            }
        });
    }

});