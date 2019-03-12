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
 * section to load each of the functions required
 */
$(document).ready(function () {
    load_expenseDatsCategory();
    load_expenseDatsCode();
    load_difficultity_level();
    // activate the side nav in createrecipe page
    $('.sidenav').sidenav();

    /**
     *
     * loads each of the categories within the createrecipe page
     */
    function load_expenseDatsCategory() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: getUrl('/categorySelect'),
            method: "POST",

            success: function (response) {
                $.each(response, function (i, value) {
                    $('#category').append($('<option>').text(value.categoryName).attr('value', value.categoryName).attr('id', value.categoryid));
                });
                $('#category').formSelect();

            },
            error: function (response) {
                alert('Ooops something went wrong!');
            }

        });
    }


    /**
     *  loads all of the codes that render on the createrecipe page
     *
     */
    function load_expenseDatsCode() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: getUrl('/codeSelect'),
                method: "POST",

                success: function (response) {
                    $.each(response, function (i, value) {
                        $('#dropDownCode').append($('<option>').text(value.code).attr('value', value.code_allowed).attr('id', value.code_id));

                    });
                    $('#dropDownCode').formSelect();

                },
                error: function (response) {
                    alert('Ooops something went wrong!');
                }

            });
        }

    /**
     * function to load difficulty level
     */
    function load_difficultity_level() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: getUrl('/createLevel'),
            method: "POST",

            success: function (response) {
                $.each(response, function (i, value) {
                    $('#dropDown').append($('<option>').text(value.difficultity).attr('value', value.difficultity).attr('id', value.effort_level_id));
                });
                $('#dropDown').formSelect();

            },
            error: function (response) {
                alert('Ooops something went wrong!');
            }

        });
    }





});