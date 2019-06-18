<div class="last-screen-main-div">
    <div class="row">
            <div class="col-md-6">
                 <form id="step6" name="step6" class="reg_step" action="{{ action('HomeController@step_six') }}" method="post">
                <div class="signup-header-div">
                    <h3 class="common-header-text">Just one last thing!</h3>
                </div>
                <input type="hidden" name="business_id" value="{{$business_id}}">
                <div class="last-screen-contain-div">
                    <div class="search-input-divs">
                        <p class="title-divs">How do customers recognize your business?</p>
                        <input type="text" id="business_name" name="business_name" class="form-control" placeholder="What is your Business Name?">
                    </div>
                    <div class="business-location-div">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="title-divs">Where is your business located?</p>
                                <input type="text" name="business_address" id="business_address" class="form-control" placeholder="Address">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group location-select-box">
                                    <i class="fas fa-caret-down"></i>
                                  <select class="form-control" id="business_country" name="business_country">
                                    <option value="">Select Country</option>
                                    <option value="India">India</option>
                                    <option value="Canada">Canada</option>
                                    <option value="London">London</option>
                                    <option value="America">America</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group location-select-box">
                                    <i class="fas fa-caret-down"></i>
                                  <select class="form-control" id="business_region" name="business_region">
                                    <option value="">Select Region</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Gujrat">Gujrat</option>
                                    <option value="MP">MP</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group location-select-box">
                                    <i class="fas fa-caret-down"></i>
                                  <select class="form-control" id="business_city" name="business_city">
                                    <option value="">Select City</option>
                                    <option value="Surat">Surat</option>
                                    <option value="Navsari">Navsari</option>
                                    <option value="Bharuch">Bharuch</option>
                                    <option value="Kim">Kim</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="business_zip" name="business_zip" class="form-control" placeholder="Zip">
                            </div>
                        </div>
                    </div>

                    <div class="search-input-divs">
                        <p class="title-divs">What is your timezone?</p>
                        <div class="form-group location-select-box">
                            <i class="fas fa-caret-down"></i>
                          <select class="form-control" id="business_timezone" name="business_timezone">
                            <option value="">Timezone</option>
                            <option value="+05:30">Asia/Calcutta (+05:30)</option>
                            <option value="+05:00">Indian/Kerguelen (+05:00)</option>
                            <option value="+05:00">Asia/Karachi (+05:00)</option>
                            <option value="+05:00">Asia/Kolkata (+05:30)</option>
                          </select>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        <div class="col-md-6">
            <div class="fullscreen-map-div">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119066.41264385462!2d72.75225630862496!3d21.15934583206193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e59411d1563%3A0xfe4558290938b042!2sSurat%2C+Gujarat!5e0!3m2!1sen!2sin!4v1554368504158!5m2!1sen!2sin" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

</div>

<script>
    $("#step6").validate({
        rules: {
            "business_name": {required:true},
            "business_address": {required:true},
            "business_country": {required:true},
            "business_region": {required:true},
            "business_city": {required:true},
            "business_zip": {required:true},
            "business_timezone": {required:true},
            
        
        },

       
        errorPlacement: function(error, element) {
            return false;
        }
    })
</script>