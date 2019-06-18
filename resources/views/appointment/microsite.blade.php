@extends('layouts.app-inner')

@section('content')

<style>
 .modal-backdrop.fade {
  opacity: 1;
}
.modal-backdrop {
  background-color: rgba(0,0,0,0.5);
}
</style>
<div class="dashboard-wrapper dashboard-wrapper-new-div ">
  <div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
      <div class="ecommerce-widget">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="admin-penal-right-side-contain-common-main-div">
              <div class="card common-card-div business-logo-main staff">
                <div class="row">
                  <div class="col-md-6">
                    <h2 class="pb-2 pt-5">Microsite</h2>
                  </div>
                </div>
                <div class="business-logo text-center pd-10">
                  <div class="row">
                    <div class="col-md-2 padding-remove-div">
                      <h4 style="margin-left: -100px;" class="service-menu-heading-div">Microsite</h4>
                    </div>
                  </div>
                  <form method="post" action="#">
                    <?php  $busId = Auth::user()->unique_id; ?>
                    <div class="row">
                      <div class="staff-icon">
                      </div>
                      <div class="col-md-12 form-group  information-school text-left">
                        <input type="text" name="" class="form-control form-information shadow" placeholder="" readonly="" value="{{ url( '/'. $busId .'/appointment')}}">
                      </div>
                    </div>
                  </form>
                  <h4 style="float: left;" class="service-menu-heading-div">Microsite</h4>
                  <iframe src="{{ url( '/'. $busId .'/appointment')}}" width="1000" height="1000">
                     alternative content for browsers which do not support iframe.
                  </iframe>
                </div>       
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection