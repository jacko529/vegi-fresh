
/**
 *
 * @param url
 * @returns {string} which is the whole url - example is http://localhost:81/foodAssignment/public/
 */
function getUrl(url) {
    var getUrl = window.location;
    var baseUrll = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/public';
    return baseUrll.concat(url);
}

/**
 *
 * loading functions for individual recipe page
 */
$(document).ready(function () {
    load_ingrediants();
    load_methods();
    $('ul.tabs').tabs({
        swipeable : false,
        responsiveThreshold : 2010
    });

    /**
     *
     * function to show the ingredients for a recipe
     */
    function load_ingrediants() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/individualRecipe/ingredients'),
            method: 'post',
            data: {
                recipeID: jQuery('.grabIngrediant').attr('id'),

            },
            beforeSend: function() {
                $('#preload').show();
                $('#methodPreload').show();

            },

            success: function (result) {
                    $("#preload").hide();
                    $("#methodPreload").hide();
                console.log(result);

                for (var i = 0; i < result.length; i++) {
                    $("#ingred").append('<li>'
                        + '<a class="titleDark">' + result[i].quantities + ' </a>'
                        + '<a class="titleDark">' + result[i].ingredientName + '</a>'
                        + '</li>');
                }
                //  jQuery('.alert1').show();//jQuery('.alert1').html(result.success);
            },
            error: function (response) {
                alert('Ooops something went wrong!');
            }

        });
    }






    /**
     *
     * function to load methods via ajax
     */
    function load_methods() {
        j = 0;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/individualRecipe/methods'),
            method: 'post',
            data: {
                recipeID: jQuery('.grabIngrediant').attr('id'),

            },
            success: function (result) {
                console.log(result);

                for (var i = 0; i < result.length; i++) {
                    $("#methods").append('Method: ' + [i + 1] + '<li>'
                        + '<a class="titleDark">' + result[i].method + '</a>'
                        + '</li><br>');
                }
                //  jQuery('.alert1').show();//jQuery('.alert1').html(result.success);
            },
            error: function (response) {
                alert('Ooops something went wrong!');
            }

        });
    }
});
