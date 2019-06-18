<div class="signup-header-div">
            <h3 class="common-header-text"> Create your own service menu</h3>
        </div>
            <form id="step3" name="step3" class="reg_step" action="{{ action('HomeController@step_three') }}" method="post">
                <input type="hidden" name="business_id" value="{{$business_id}}">
        <div class="service-menu-div">
            <div class="row">
                <div class="col-md-7 padding-remove-div">
                    <h4 class="service-menu-heading-div">Service Title</h4>
                </div>
                <div class="col-md-2 padding-remove-div">
                    <h4 class="service-menu-heading-div">Duration (min)</h4>
                </div>
                <div class="col-md-2 padding-remove-div">
                    <h4 class="service-menu-heading-div">Price (INR) <i class="fas fa-pencil-alt"></i></h4>
                </div>
                <div class="col padding-remove-div">
                    
                </div>
            </div>
            
            
                <div class="row">
                <div class="col-md-7 padding-remove-div">
                    <input type="text" class="form-control disabled"  name="service[1][name]" placeholder="Hair Styling">
                </div>
                <div class="col-md-2 padding-remove-div">
                    <input type="text" class="form-control disabled" name="service[1][duration]" placeholder="6m">
                </div>
                <div class="col-md-2 padding-remove-div">
                    <input type="text" class="form-control disabled" name="service[1][price]" placeholder="No Price">
                </div>
                <div class="col mobile-padding-remove padding-remove-div">
                    <div class="close-btns">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                </div>
            
            
            <div class="rows">
                <div class="row">
                    <div class="col-md-7 padding-remove-div">
                        <input type="text" name="service[2][name]" class="form-control" >
                    </div>
                    <div class="col-md-2 padding-remove-div">
                        <input type="text" name="service[2][duration]" class="form-control" >
                    </div>
                    <div class="col-md-2 padding-remove-div">
                        <input type="text" name="service[2][price]" class="form-control" >
                    </div>
                    <div class="col mobile-padding-remove padding-remove-div">
                        <div class="close-btns">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                </div>
            </div>    
        </form>
            <div class="add-row-link-div">
                <button class="btn add-service-btn-div"><i class="fas fa-plus"></i> Add Service</button>
            </div>

     </div>    

    <script>
    $("#step3").validate({
		rules: {
            "service[1][name]": "required",
            "service[1][duration]": "required",
			"service[1][price]": "required",
            "service[2][name]": "required",
            "service[2][duration]": "required",
            "service[2][price]": "required",

        
        },

       
        errorPlacement: function(error, element) {
            return false;
        }
    })
    </script>