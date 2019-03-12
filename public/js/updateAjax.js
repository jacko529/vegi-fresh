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
     * append ingredients as a list once the user has finished searching
     * @param e
     */
    document.getElementById("buttonIngredientSubmit").onclick = function (e) {
        var ingrideantName = $('.ingredient').val();
        var ingrideantAmount = $('#amount').val();
        var ingridiantID = $('.ingredient').attr('id');
        var output = '';
        output += '<tr class="row-update">';
        output += '<td  class="updateIngredient"><p>' + ingrideantName + ' </p></td>';
        output += '<td class="IngriAmount"><p id ="' + ingridiantID + '"class="updateAmount">' + ingrideantAmount + '</p></td>';
        output += '</tr>';
        $('.ingridieant-listy').append(output);
        $('.ingredient').attr('id','ingredient_name');

    };


    /***
     * ajax auto complete - key up and will query ingredients table
     * return data to id tag countryList
     */
    $('#ingredient_name').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:getUrl('/createrecipe/show'),
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                    $('#countryList').fadeIn();
                    $('#countryList').html(data);
                }
            });
        }
    });
    /*
* click on the dropdown item and it will append to the input tag
    */
    $(document).on('click', 'li', function(){
        $('#ingredient_name').val($(this).text());
        $('#ingredient_name').attr('id', $(this).attr('id'));
        $('#countryList').fadeOut();
    });

    /**
     *
     * function to append methods once the user has completed them
     */
    $('#methodExtraValue').click(function () {
        var methodTransfer = $('#extraMethods').val();
        $('#extraMethodList').append('<input type="text" id="0" class="updateMethod" value="'+ methodTransfer + '">');
    });





    /**
     *
     * function to update methods and ingredients of individual recipes
     * ajax request
     */
    jQuery('#updateSubmit').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var methodArray = [];
        // create js array of methods
        $(".updateMethod").each(function() {
            methodArray.push({
                methodid: $(this).attr("id"),
                methodName: $(this).val()
            });
        });
        var ingrediantArray = [];
        // create js array of ingrediants
        $(" .updateAmount").each(function() {
                ingrediantArray.push({
                    ingrediantId: $(this).attr("id"),
                    quantity: $(this).text(),

                });

        });
        var jsonString = JSON.stringify(methodArray);
        var jsonStringIngred = JSON.stringify(ingrediantArray);


        jQuery.ajax({
            url: getUrl('/updateTime/try'),
            method: 'post',
            cache: false,
            dataType: 'json',
            data: {
                recipe_id: jQuery('#recipe_id').text(),
                recipe_name: jQuery('#receipeName').val(),
                picture_location: jQuery(".find").find('#file_name').val(),
                effort_level_id: jQuery('#updateEffort option:selected').attr('id'),
                code_id: jQuery('#updateCode option:selected').attr('id'),
                description: jQuery('#updateDescription').val(),
                prepTime: jQuery('#updatePrep').val(),
                cookingTime: jQuery('#updateCookTime').val(),
                serves: jQuery('#serves').val(),
                method: jsonString,
                Calories: $('#Calories').val(),
                sodium: $('#Sodium').val(),
                fat: $('#Fat').val(),
                protein: $('#protein').val(),
                carbs: $('#carbs').val(),
                fibre: $('#Fibre').val(),
                ingredi: jsonStringIngred,

                id: 1,
            },
            success: function (result) {
                if (result.success) {
                    window.location= getUrl('/admin')
                }
            }
        });

    });
    /**
     *
     * method to store delete previous ingredients previous recipes
     */
    $("#deleteIngrediant").unbind('click').click(
        function(e)
        {
            e.preventDefault();
            var idSelector = function() { return this.id; };
            var checkedValues = $('input:checkbox:checked.checkedIngrediant').map(idSelector).get();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: getUrl('/updateTime/deleteNow') ,
                method: 'post',
                data: {

                    ingredientName: checkedValues,

                },
                success: function (result) {
                    $('.ingrediantTable').load( ' .ingrediantTable');

                }
            });

        });


    /**
     * delete the method
     *
     *
     */
    $("#deleteMethod").unbind('click').click(
        function(e)
        {
            e.preventDefault();
            var idSelector = function() { return this.id; };
            var checkedValues = $('input:checkbox:checked.checkedMethod').map(idSelector).get();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: getUrl('/updateTime/deleteNowMethod') ,
                method: 'post',
                data: {

                    methodID: checkedValues,

                },
                success: function (result) {
                    $('.methodSection').load( ' .methodSection');

                }
            });

        });
});




