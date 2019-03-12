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



jQuery(document).ready(function () {


    /**
     *
     * function to add a new category to system.
     */
    jQuery('#categorySubmit').click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/createrecipe/insertCategory'),
            method: 'post',
            data: {
                categoryName: jQuery('#categoryName').val(),
            },
            success: function (result) {
                $('#addCategory').empty();
                $('#addCategoryError').empty();
                jQuery('#addCategory').append(result.success);
                jQuery('#addCategoryError').append(result.error);
            }
        });
    });

    /**
     *
     * function to add a new ingredient to system
     */
    jQuery('#ajaxSubmit').click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/createrecipe/storeIn'),
            method: 'post',
            data: {
                ingredientName: jQuery('#ingredientName').val(),
            },
            success: function (result) {
                $('#addIngredientSuccess').empty();
                $('#addIngredientError').empty();
                jQuery('#addIngredientSuccess').append(result.success);
                jQuery('#addIngredientError').append(result.error);
            }
        });

    });

    /***
     * ajax auto complete - key up and will query ingredients table
     * return data to id tag ingredient_list
     */
    $('#ingredient_name_insert').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:getUrl('/createrecipe/show'),
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                    $('#ingredient_list').fadeIn();
                    $('#ingredient_list').html(data);
                }
            });
        }
    });

    /**
     *
     *
     */
    $('.vegiChecked').change(function() {
        if($(this).is(":checked")) {
            $(this).attr("id", '1');
        }
        else if ($(this).not(":checked")){
            $(this).attr("id", '0');

        }
    });

    /**
     *  trigger model
     */
    /**
     *
     * function to add the first part of a recipe
     *
     */
    jQuery('#submitRecipe').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: getUrl('/createrecipe/recipeStore'),
            method: 'post',
            cache: false,
            dataType: 'json',
            data: {
                recipe_name: jQuery('#receipeName').val(),
                picture_location: jQuery(".find").find('#file_name').val(),
                effort_level_id: jQuery('#dropDown option:selected').attr('id'),
                vegi : jQuery('.vegiChecked').attr('id'),
                code_id: jQuery('#dropDownCode option:selected').attr('id'),
                description: jQuery('#description').val(),
                length_of_time: jQuery('#lengthOfTime').val(),
                cookingTime: jQuery('#cookingTime').val(),
                serves: jQuery('#serves').val(),
                // for the purpose of the prototype this will be 1
                id: 1,
            },
            success: function (result) {
                if(result.errors) {
                    jQuery.each(result.errors, function (key, value) {
                        if (value.includes('recipe name')) {
                            $('#recipe-error').html(value);
                        }
                        else if (value.includes('picture location')) {
                            $('#picture-error').html(value);

                        }
                        else if (value.includes('code id')) {
                            $('#code-error').html(value);

                        }
                        else if (value.includes('effort')) {
                            $('#difficulty-error').html(value);

                        }
                        else if (value.includes('description')) {
                            $('#description-error').html(value);

                        }
                        else if (value.includes('length of time')) {
                            $('#prep-error').html(value);

                        }
                        else if (value.includes('cooking time')) {
                            $('#cooking-error').html(value);

                        }
                        else if (value.includes('serves')) {
                            $('#serving-error').html(value);

                        }
                    });
                }
                else {
                $('.trydiv').html('Recipe : ');
                $('.recipe_id_number').html(result.recipe_id );
                $('.numbertryDiv').html(result);
                }
            }
        });

    });

    /**
     * triggering the materialize modal
     */
    $('.modal').modal();


    /**
     *
     * function to append methods once the user has completed them
     */
    $('#newMethodValue').click(function () {
        var methodTransfer = $('#textareaNow').val();
        $('#methodTime').append('<li class="methodName" >'+ methodTransfer + '</li>');
    });

    /**
     *
     * function to add the second part of a recipe
     *
     */
    jQuery('#submitRecipePartTwo').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var ingriAmount = "";
        var ingriName = "";
        var methodName = "";

        $('.IngriAmount').each(function () {
            ingriAmount += $(this).text() + '+';
        });
        $('.IngriName').each(function () {
            ingriName += $(this).attr('id') + '+';
        });
        $('.methodName').each(function () {
            methodName += $(this).text() + '+';
        });
        jQuery.ajax({
            url: getUrl('/createrecipe/recipeStoreTwo'),
            method: 'post',
            cache: false,
            dataType: 'json',
            data: {
                recipe_id: $('.recipe_id_number').text(),
                Calories: $('#Calories').val(),
                sodium: $('#Sodium').val(),
                fat: $('#Fat').val(),
                protein: $('#Protein').val(),
                carbs: $('#Carbs').val(),
                fibre: $('#Fibre').val(),
                method: methodName,
                ingridents: ingriName,
                quantities: ingriAmount,
                catagory_id: $('#category option:selected').attr('id'),
            },
            success: function (result) {

                jQuery.each(result.errors, function(key, value){
                    if(value.includes('Calories') || value.includes('sodium') ||
                        value.includes('fat') || value.includes('protein') ||
                        value.includes('carbs') || value.includes('fibre'))
                    {
                        $('#incorrect-storeTwo').show();
                        $( '#incorrect-storeTwo' ).append('<strong class="center-align red-text" >'+value+'</strong><br>')
                    }
                    else if(value.includes('method'))
                    {
                        $( '#incorrect-method' ).html( value );
                    }
                    else if(value.includes('catagory'))
                    {
                        $( '#incorrect-category' ).html( value );
                    }
                    else if(value.includes('ingridents') || value.includes('quantities'))
                    {
                        $( '#ingred-list' ).append( value );
                    }

                  //  jQuery('#incorrect-storeTwo').show();
                   // jQuery('#incorrect-storeTwo').append('<p class="center-align red-text">'+value+'</p>');
                });


                jQuery('.alert').show();
                jQuery('.successInsert').html(result.success);

            }
        });

    });


    /**
     *
     * function for when the code is changed the week is appended below the select element
     *
     * @type {HTMLElement}
     */
    var select = document.getElementById("dropDownCode");
    select.onchange = function () {
        var selectedString = select.options[select.selectedIndex].value;
        $('#dateCode').html("Week of: " + selectedString);


    };




    /**
     * click on the dropdown item and it will append to the input tag
     */
    $(document).on('click', 'li', function(){
        $('#ingredient_name_insert').val($(this).text());
        $('#ingredient_name_insert').attr('id', $(this).attr('id'));
        $('#ingredient_list').fadeOut();
    });
    /**
     *
     * on the createrecipe page append new recipes once have been selected
     *
     * @param e
     */
    document.getElementById("buttonInSubmit").onclick = function (e) {

        var ingrideantName = $('.ingredient_name_insert').val();
        var ingrideantAmount = $('#amount').val();
        var ingridiantID = $('.ingredient_name_insert').attr('id');
        if(ingrideantName === '' || ingrideantAmount === '')
        {
            $( '#ingred' ).html( 'The ingredient name needs to be filled out' );

        }
        else {
            $('.ingridieant-list').append('<tr>');
            $('.ingridieant-list').append('<td id ="' + ingridiantID + '" class="IngriName"><p>' + ingrideantName + ' </p></td>');
            $('.ingridieant-list').append('<td class="IngriAmount"><p>' + ingrideantAmount + '</p></td>');
            $('.ingridieant-list').append('</tr>');
            $('.ingredient_name_insert').attr('id','ingredient_name_insert');

        }
    };



    /**
     * change the picture of the recipe
     */
    function changeProfile() {
        $('#file').click();
    }

    /**
     *
     * change the picture to the new one selected
     */
    $('#file').change(function () {
        if ($(this).val() != '') {
            upload(this);

        }
    });

    /**
     *
     * trigger the change profile function
     */
    $(document).on('click', '#changProfile', function() {
        changeProfile();
    });

    /**
     *
     * trigger the change profile function
     */
    $(document).on('click', '#removeFile', function() {
        removeFile();
    });

    /**
     *
     * upload the image to the assets folder
     *
     * @param img
     */
    function upload(img) {
        var form_data = new FormData();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        form_data.append('file', img.files[0]);
        $('#loading').css('display', 'block');
        $.ajax({
            url: getUrl('/ajax-image-upload'),
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#preview_image').attr('src',getUrl('/storage/noimage.jpg'));
                    alert(data.errors['file']);
                }
                else {
                    $('#file_name').val(data);
                    $('#preview_image').attr('src', getUrl('/storage')+'/' + data);

                }
                $('#loading').css('display', 'none');


            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
                $('#preview_image').attr('src', getUrl('/storage/noimage.jpg'));
            }
        });
    }

    /**
     *
     * remove the image from the folder
     */
    function removeFile() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($('#file_name').val() != '')
            if (confirm('Are you sure want to remove profile picture?')) {
                $('#loading').css('display', 'block');
                var form_data = new FormData();
                form_data.append('_method', 'DELETE');
                form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: "/ajax-remove-image/" + $('#file_name').val(),
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#preview_image').attr('src', getUrl('/storage/noimage.jpg'));
                        $('#file_name').val('');
                        $('#loading').css('display', 'none');
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }
    }


});
