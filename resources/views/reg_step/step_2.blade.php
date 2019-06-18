<div id="screen-one" class="common-secreen-div selected">
    <div class="signup-header-div">
        <h3 class="common-header-text"> What type of services do you provide?</h3>
    </div>
    <div class="multiple-service-category-div">
        <div class="row">
            <div class="col-md-4 padding-remove-div">
                <div class="services-contain-div">
                    <div class="icons-div">
                        <img src="assets/images/icon1.png" class="img-fluid">
                    </div>
                    <div class="service-text-divs">
                        <h5 class="services-box-heading">Beauty & Wellness</h5>
                        <p class="services-box-para">Salons, Spas, Life Coaches</p>
                    </div>
                </div>
            </div>

        </div> <!-- row -->
        <div class="multiple-service-category-search-div">
            <p class="search-heading-div">Can’t find what you are looking for?</p>
            <input type="text" class="form-control search-input-field" placeholder="Search">
        </div>
    </div> <!-- multiple-service-category-div -->
</div>



 <div id="screen-two-search-box" style="display: none;">
    <div class="signup-header-div">
        <h3 class="common-header-text">Beauty & Wellness</h3>
        <label class="close-btn-main-div">
            <i class="fas fa-times"></i>
        </label>
    </div>
    <div class="search-category-main-box">
    <form id="step2" name="step2" class="reg_step" action="{{ action('HomeController@step_two') }}" method="post">
        @csrf
        <div class="input-filed-div">
            <input type="text" class="form-control" placeholder="Search">
            <input type="hidden" name="business_id" value="{{$business_id}}">
        </div>
        <div class="input-field-data-div servicecat" >
            <div class="input-data-div">
                 <input type="hidden" name="service_id" value="1">
                Barber
            </div>
          
        </div>
    </form>
    </div>
</div> <!-- screen-two-search-box -->

