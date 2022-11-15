
<script src="{{ asset('js/admin/app.js') }}"></script>
<script src="{{ asset('js/admin/custom.js') }}"></script>
<script src="{{ asset('js/admin/datatable.js') }}"></script>
<script>
    $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
    });

    $(document).ready(function() {
        ///////////-------For services --------///////////
        var addservicesButton = $('.add_service_button'); //Add button selector
        var servicewrapper = $('.service_field_wrapper'); //Input field wrapper
        var servicefieldHTML = '<div class="removes_service row"><div class="col-md-5 mb-2"><div class="error-placeholder"><input type="text" class="form-control" placeholder="Add services" name="type_services[]"></div></div><div class="col-md-1 text-danger remove_service cursor-pointer">Remove</div></div>'; //New input field html
      
        $(addservicesButton).click(function() {
		//Check maximum number of input fields
			$(servicewrapper).append(servicefieldHTML); //Add field html
		
        });
        $(servicewrapper).on("click", ".remove_service", function() {
            $(this).parents(".removes_service").remove();
        });
        ///////////-------end services --------///////////
//**********************************************************************************************************//
        ///////////-------For foods --------///////////
        var addfoodsButton = $('.add_foods_button'); //Add button selector
        var foodwrapper = $('.foods_field_wrapper'); //Input field wrapper
        var foodfieldHTML = '<div class="removes_food row"><div class="col-md-5 mb-2"><div class="error-placeholder"><input type="text" class="form-control" placeholder="Add foods" name="type_foods[]"></div></div><div class="col-md-1 text-danger remove_food cursor-pointer">Remove</div></div>'; //New input field html
      
        $(addfoodsButton).click(function() {
		//Check maximum number of input fields
			$(foodwrapper).append(foodfieldHTML); //Add field html
		
        });
        $(foodwrapper).on("click", ".remove_food", function() {
            $(this).parents(".removes_food").remove();
        });
        ///////////-------end foods --------///////////
//**********************************************************************************************************//
        ///////////-------For occasion --------///////////
        var addOccasionButton = $('.add_occasion_button'); //Add button selector
        var occasionwrapper = $('.occasion_field_wrapper'); //Input field wrapper
        var occasionfieldHTML = '<div class="removes_occasion row"><div class="col-md-5 mb-2"><div class="error-placeholder"><input type="text" class="form-control" placeholder="Add occasion" name="type_occasion[]"></div></div><div class="col-md-1 text-danger remove_occasion cursor-pointer">Remove</div></div>'; //New input field html
      
        $(addOccasionButton).click(function() {
		//Check maximum number of input fields
			$(occasionwrapper).append(occasionfieldHTML); //Add field html
		
        });
        $(occasionwrapper).on("click", ".remove_occasion", function() {
            $(this).parents(".removes_occasion").remove();
        });
        ///////////-------end occasion --------///////////
//**********************************************************************************************************//
        ///////////-------For Meals --------///////////
        var addMealsButton = $('.add_meals_button'); //Add button selector
        var mealswrapper = $('.meals_field_wrapper'); //Input field wrapper
        var mealsfieldHTML = '<div class="removes_meals row"><div class="col-md-5 mb-2"><div class="error-placeholder"><input type="text" class="form-control" placeholder="Add meals" name="type_meals[]"></div></div><div class="col-md-1 text-danger remove_meals cursor-pointer">Remove</div></div>'; //New input field html
      
        $(addMealsButton).click(function() {
		//Check maximum number of input fields
			$(mealswrapper).append(mealsfieldHTML); //Add field html
		
        });
        $(mealswrapper).on("click", ".remove_meals", function() {
            $(this).parents(".removes_meals").remove();
        });
        ///////////-------end meals --------///////////
    });
</script>
