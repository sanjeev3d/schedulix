@foreach($customerData as $user)
  <div class="card costom-card-new-div" id="customer_block_{{$user->id}}">
    <div class="card-header" id="heading-{{$user->id}}">
      <h5 class="mb-0">
        <a role="button" data-toggle="collapse" href="#collapse-{{$user->id}}" aria-expanded="true" aria-controls="collapse-{{$user->id}}">
          <div class="Header-contain-div">
            <div class="user-details-div">
              <img src="{{asset('assets/images/user-img-big.png')}}" class="img-fluid">
              <span class="user-name-div">{{$user->name}}&nbsp;{{$user->last_name}}</span>
            </div>
            <div class="edit-close-div">
              <a href="javascript:void(0)" class="img-fluid edit-customer" id="{{$user->id}}"><img class="img-fluid " src="{{asset('assets/images/edit-imgs.png')}}" ></a>
              <a href="javascript:delete_account('{{$user->id}}','deletecategory','proceed')" class="remove-customer" id="{{$user->id}}"><img src="{{asset('assets/images/close-imgs.png')}}" class="img-fluid"></a>
            </div>
          </div>
        </a>
      </h5>
    </div>
    <div id="collapse-{{$user->id}}" class="collapse " data-parent="#accordion" aria-labelledby="heading-{{$user->id}}">
      <div class="card-body card-body-new-div">
        <div class="accordion-contain-div">
          <p class="para-div">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
          <p class="para-div">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        </div>
      </div>
    </div>
  </div>
@endforeach 