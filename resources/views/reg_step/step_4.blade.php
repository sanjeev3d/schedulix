<div class="signup-header-div">
    <h3 class="common-header-text">Who works at your business?</h3>
</div>
<form id="step4" name="step4" class="reg_step" action="{{ action('HomeController@step_four') }}" method="post" >
    <input type="hidden" name="business_id" value="{{$business_id}}">
<div class="service-menu-div">
    <div class="row">
        <div class="col padding-remove-div">
        </div>
        <div class="col-md-3 padding-remove-div">
            <h4 class="service-menu-heading-div">Staff Name</h4>
        </div>
        <div class="col-md-3 padding-remove-div">
            <h4 class="service-menu-heading-div">Email</h4>
        </div>
        <div class="col-md-2 padding-remove-div">
            <h4 class="service-menu-heading-div">Mobile (Optional)</h4>
        </div>
        <div class="col-md-2 padding-remove-div">
            <h4 class="service-menu-heading-div">Role</h4>
        </div>
        <div class="col padding-remove-div">
            
        </div>
    </div>
    <div class="row">
        <div class="col padding-remove-div dot-symbol-parent"> 
            <div class="light-dots-div dot-symbol">
            </div>
        </div>
        <div class="col-md-3 padding-remove-div">
            <input type="text" class="form-control disabled" placeholder="Zia" name="staff[1][name]">
        </div>
        <div class="col-md-3 padding-remove-div">
            <input type="text" class="form-control disabled" placeholder="hafiz.zia@msn.com" name="staff[1][email]">
        </div>
        <div class="col-md-2 padding-remove-div">
            <input type="text" class="form-control disabled" placeholder="" name="staff[1][phone]">
        </div>
        <div class="col-md-2 padding-remove-div">
            <div class="form-group add-staff-select-box">
                <i class="fas fa-caret-down"></i>
              <select class="form-control changeColor" name="staff[1][role]">
                <option value="">Select Role</option>
                <option value="3">Manager</option>
                <option value="4">Staff</option>
              </select>
            </div>
        </div>
        <div class="col mobile-padding-remove padding-remove-div">
            <div class="close-btns">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col padding-remove-div dot-symbol-parent"> 
            <div class="light-dots-div dot-symbol">
            </div>
        </div>
        <div class="col-md-3 padding-remove-div">
            <input type="text" class="form-control disabled" placeholder="Atiq" name="staff[2][name]">
        </div>
        <div class="col-md-3 padding-remove-div">
            <input type="text" class="form-control disabled" placeholder="atiq@msn.com" name="staff[2][email]">
        </div>
        <div class="col-md-2 padding-remove-div">
            <input type="text" class="form-control disabled" placeholder="345678" name="staff[2][phone]">
        </div>
        <div class="col-md-2 padding-remove-div">
            <div class="form-group add-staff-select-box">
                <i class="fas fa-caret-down"></i>
              <select class="form-control changeColor" name="staff[2][role]">
                <option value="">Select Role</option>
                <option value="3">Manager</option>
                <option value="4">Staff</option>
              </select>
            </div>
        </div>
        <div class="col mobile-padding-remove padding-remove-div">
            <div class="close-btns">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
    <div class="add-staff-rows">
        <div class="row">
            <div class="col padding-remove-div dot-symbol-parent"> 
                <div class="light-dots-div dot-symbol">
                </div>
            </div>
            <div class="col-md-3 padding-remove-div">
                <input type="text" class="form-control" placeholder="" name="staff[3][name]">
            </div>
            <div class="col-md-3 padding-remove-div">
                <input type="text" class="form-control" placeholder="" name="staff[3][email]">
            </div>
            <div class="col-md-2 padding-remove-div">
                <input type="text" class="form-control" placeholder="" name="staff[3][phone]">
            </div>
            <div class="col-md-2 padding-remove-div">
                <div class="form-group add-staff-select-box">
                    <i class="fas fa-caret-down"></i>
                  <select class="form-control changeColor" name="staff[3][role]">
                    <option value="">Select Role</option>
                    <option value="3">Manager</option>
                    <option value="4">Staff</option>
                  </select>
                </div>
            </div>
            <div class="col mobile-padding-remove padding-remove-div">
                <div class="close-btns">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
    </div>

    </form>

    <div class="add-row-link-div add-staff-btn-main-div">
        <div class="btns-div">
            <button class="btn add-staff-btn-div"><i class="fas fa-plus"></i> Add Staff</button>
        </div>
        <div class="staff-mang-div">
            <div class="name-divs">
                <label class="light-dots-div"></label><span class="name-text">Staff</span>
            </div>
            <div class="name-divs">
                <label class="dark-dots-div"></label><span class="name-text">Manager</span>
            </div>
        </div>
    </div>

</div>    

<script>
    $("#step4").validate({
        rules: {
            // "staff[1][name]": {required:true},
            // "staff[1][email]": {required:true,email:true},
            // "staff[1][role]": "required",
            // "staff[2][name]": "required",
            // "staff[2][email]": {required:true,email:true},
            // "staff[2][role]": "required",
            // "staff[3][name]": "required",
            // "staff[3][email]": {required:true,email:true},
            // "staff[3][role]": "required",
        
        },

       
        errorPlacement: function(error, element) {
            return false;
        }
    })

    $(document).on('change','.changeColor',function(){
        var getType = $(this).val();
        if(getType == '3'){
            $(this).parent().parent().siblings('.dot-symbol-parent').children('.dot-symbol').removeClass('light-dots-div');
            $(this).parent().parent().siblings('.dot-symbol-parent').children('.dot-symbol').addClass('dark-dots-div');
        } else{
            $(this).parent().parent().siblings('.dot-symbol-parent').children('.dot-symbol').removeClass('dark-dots-div');
            $(this).parent().parent().siblings('.dot-symbol-parent').children('.dot-symbol').addClass('light-dots-div');
        }
    })
</script>