@extends('layouts.app-inner')

@section('content')

<div class="dashboard-wrapper dashboard-wrapper-new-div ">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
             <div class="ecommerce-widget">
                <div class="row">

                    @if(isset($success))
                    <div class="alert alert-success">{{ $success }}</div>
                    @endif
                    @if(isset($error))
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endif
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                {{ Session::get('success') }}
                           </div>
                        @endif

                        @if(session()->has('error'))
                        <div class="alert alert-danger">{{ session()->get('error') }}</div>
                        @endif


                        <?php
                        /*echo "<pre>";
                        print_r($users_privacy);
                        die;*/
                        ?>
                        <div class="admin-penal-right-side-contain-common-main-div privacy">
                            <form method="post" action="{{ route('privacy.store') }}">
                                @csrf
                                <div class="card common-card-div">
                                    <h2 class="pb-2">Privacy Policy</h2>
                                    <div class="row business-logo">
                                        <!-- <div class="col-md-12 common-height-div">
                                            <div class="form-group common-check-box-div">
                                                <label><b>Reviews: </b></label>
                                                <label class="containersss">Show your customer's name with their reviews
                                                  <input type="checkbox" name="chk_reviews" class="form-control" {{ ($users_privacy[0]->customer_review ?? $users_privacy) == 'true' ? 'checked' : '' }}  value="true" />
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            @if ($errors->has('chk_reviews'))
                                            <span class="help-block" style="color: red;"><strong>{{ $errors->first('chk_reviews') }}</strong></span>
                                            @endif
                                        </div> -->
                                        <div class="col-md-12 common-height-div">
                                            <div class="form-group common-check-box-div">
                                                <label><b>Social Promotion: </b></label>
                                                <label class="containersss">Allow your customers to promote their appointment on social networks
                                                   <input type="checkbox" name="chk_social_prom" class="form-control" {{ ($users_privacy[0]->social_promotion ?? $users_privacy) == 'true' ? 'checked' : '' }} value="true" />
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            @if ($errors->has('chk_social_prom'))
                                            <span class="help-block" style="color: red;"><strong>{{ $errors->first('chk_social_prom') }}</strong></span>
                                            @endif
                                        </div>
                                        <?php
                                        /*echo "<pre>";
                                        print_r($users_privacy->toArray());
                                        die;*/
                                        ?>
                                        <div class="col-md-12">
                                            <label><b>Terms & Conditions: </b><span style="color: red;">*</span></label>
                                            <textarea type="text" name="term_conditions" id="term-condition" class="form-control" cols="30" rows="10"><?php if(isset($users_privacy[0])){ echo $users_privacy[0]->terms_condition; } ?></textarea><br>
                                            <p><span id="wordCount">2500</span> Character Remaining</p>
                                            @if ($errors->has('term_conditions'))
                                            <span class="help-block" style="color: red;"><strong>{{ $errors->first('term_conditions') }}</strong></span>
                                            @endif
                                            <div class="col-md-12 business-button">
                                                <button type="submit" name="submit" class="btn" style="float: right;">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }} "></script>
<script type="text/javascript">
    $(document).ready(function(){
        wordCount();
    });

    function wordCount(){
        abc =   $('#term-condition').val();
        if(abc){
            if(2500 - abc.length <= 0){
            $('#wordCount').text('0');
          }else{

            $('#wordCount').text(2500-abc.length);
          }
        }
        $(document).on('keyup','#term-condition',function(){
          var abc = $(this).val();
          if(2500 - abc.length <= 0){
             $('#wordCount').text('0');
          }else{
            $('#wordCount').text(2500-abc.length);
          }
        })

    }
</script>