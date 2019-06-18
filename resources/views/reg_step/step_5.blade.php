<div class="signup-header-div">
    <h3 class="common-header-text">Add business hours to let customers know when you are open</h3>
</div>
<div class="customer-hours-main-div">
    <form id="step5" name="step5" class="reg_step" action="{{ action('HomeController@step_five') }}" method="post">
        <input type="hidden" name="business_id" value="{{$business_id}}">
        <div class="row">
            <div class="col-md-12 custom-padding-divss">
                <div class="row custom-margin-div">
                    <div class="col-md-3 padding-remove-div">
                        <div class="customer-date-divs">
                            <label class="containerdsd">Monday
                              <input type="checkbox" class="common-checkbox-div" id="monday" name="week[monday][check]" checked="checked">
                              <span class="checkmark" style="border:unset;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[monday][from]" class="form-control" id="monday-from" value="" placeholder="Start Time">
                        </div>
                    </div>
                    <div class="col padding-remove-div">
                        <div class="date-to-text">
                            <p>To</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[monday][to]" placeholder="End Time" class="form-control" value="" id="monday-to">
                        </div>
                    </div>
                </div>
                <div class="row custom-margin-div">
                    <div class="col-md-3 padding-remove-div">
                        <div class="customer-date-divs">
                            <label class="containerdsd">Tuesday
                              <input type="checkbox" id="tuesday" class="common-checkbox-div" name="week[tuesday][check]" checked="checked">
                              <span class="checkmark" style="border:unset;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[tuesday][from]" placeholder="Start Time" class="form-control" value="" id="tuesday-from">
                        </div>
                    </div>
                    <div class="col padding-remove-div">
                        <div class="date-to-text">
                            <p>To</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[tuesday][to]" placeholder="End Time" class="form-control" value="" id="tuesday-to">
                        </div>
                    </div>
                </div>
                <div class="row custom-margin-div">
                    <div class="col-md-3 padding-remove-div">
                        <div class="customer-date-divs">
                            <label class="containerdsd">Wednesday
                              <input type="checkbox" id="wednesday" class="common-checkbox-div" name="week[wednesday][check]" checked="checked">
                              <span class="checkmark" style="border:unset;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[wednesday][from]" placeholder="Start Time" class="form-control" value="" id="wednesday-from">
                        </div>
                    </div>
                    <div class="col padding-remove-div">
                        <div class="date-to-text">
                            <p>To</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[wednesday][to]" placeholder="End Time" class="form-control" value="" id="wednesday-to">
                        </div>
                    </div>
                </div>
                <div class="row custom-margin-div">
                    <div class="col-md-3 padding-remove-div">
                        <div class="customer-date-divs">
                            <label class="containerdsd">Thursday
                              <input type="checkbox" id="thursday" class="common-checkbox-div" name="week[thursday][check]" checked="checked">
                              <span class="checkmark" style="border:unset;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[thursday][from]" placeholder="Start Time" class="form-control" value="" id="thursday-from">
                        </div>
                    </div>
                    <div class="col padding-remove-div">
                        <div class="date-to-text">
                            <p>To</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[thursday][to]" placeholder="End Time" class="form-control" value="" id="thursday-to">
                        </div>
                    </div>
                </div>
                <div class="row custom-margin-div">
                    <div class="col-md-3 padding-remove-div">
                        <div class="customer-date-divs">
                            <label class="containerdsd">Friday
                              <input type="checkbox" id="friday" class="common-checkbox-div" name="week[friday][check]" checked="checked">
                              <span class="checkmark" style="border:unset;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[friday][from]" placeholder="Start Time" class="form-control" value="" id="friday-from">
                        </div>
                    </div>
                    <div class="col padding-remove-div">
                        <div class="date-to-text">
                            <p>To</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[friday][to]" placeholder="End Time" class="form-control" value="" id="friday-to">
                        </div>
                    </div>
                </div>
                <div class="row custom-margin-div">
                    <div class="col-md-3 padding-remove-div">
                        <div class="customer-date-divs">
                            <label class="containerdsd">Saturday
                              <input type="checkbox" id="saturday" class="common-checkbox-div" name="week[saturday][check]">
                              <span class="checkmark" ></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[saturday][from]" class="form-control disabled" placeholder="Start Time" value="" id="saturday-from">
                        </div>
                    </div>
                    <div class="col padding-remove-div">
                        <div class="date-to-text">
                            <p>To</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[saturday][to]" class="form-control disabled" placeholder="End Time" value="" id="saturday-to">
                        </div>
                    </div>
                </div>
                <div class="row custom-margin-div">
                    <div class="col-md-3 padding-remove-div">
                        <div class="customer-date-divs">
                            <label class="containerdsd">Sunday
                              <input type="checkbox" id="sunday" class="common-checkbox-div" name="week[sunday][check]">
                              <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" name="week[sunday][from]" class="form-control disabled" placeholder="Start Time" value="" id="sunday-from">
                        </div>
                    </div>
                    <div class="col padding-remove-div">
                        <div class="date-to-text">
                            <p>To</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-remove-div">
                        <div class="date-time-div">
                            <input type="text" id="sunday-to" name="week[sunday][to]" class="form-control" placeholder="End Time" value="">
                        </div>
                    </div>
                </div>
            </div>
            <span id="step_5_error" style="display: none;color: #f00; width: 100%; float: left; text-align: center;">Please select business type.</span>
        </div>
    </form>

</div>    

<script type="text/javascript">
    $(function () {
        $('#monday-from,#monday-to,#tuesday-from,#tuesday-to,#wednesday-from,#wednesday-to,#thursday-from,#thursday-to,#friday-from,#friday-to,#saturday-from,#saturday-to,#sunday-from,#sunday-to').datetimepicker({
            format: 'LT'
        });
    });

    $("#step5").validate({
        

       
        errorPlacement: function(error, element) {
            return false;
        }
    })
</script>