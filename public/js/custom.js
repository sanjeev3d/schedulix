/****
Delete Function For All Section
*****/
  function delete_account(id, type, extra_param)
  {
    var action = extra_param;
    var params = {}
    params['token'] = $('meta[name="csrf-token"]').attr('content')
    params['id'] = id
    params['type'] = type
    params['extra_param'] = extra_param

    Swal.fire({
    title: 'Are you sure?',
    text: 'You want to proceed?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, keep it'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Deleted!',
          'Your data has been deleted.',
          'success'
        )
        $.ajax({
             url: base_url + '/delete/item',
             async:false,
             // contentType: false,
             // processData: false,
             method:'POST',
             data:params,
             success:function(msg){
              var text = msg.status;
              swal({
                title:'', 
                text:text,
                type:'success',
                // html:true 
              });
              //dataTableInstance.draw(); 
              if(msg.type=='proceed')
              {
               window.open(base_url + '/customers', "_self");
              }
              else if(msg.type=='deleteappointment'){
                   window.open(base_url + '/appointment', "_self");
              }
              else if(msg.type=='deletestaff'){
                   window.open(base_url + '/staff', "_self");
              }
              else
              {
                return;
              }
            }
         });
      // For more information about handling dismissals please visit
      // https://sweetalert2.github.io/#handling-dismissals
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire(
          'Cancelled',
          'Your data is safe :)',
          'error'
        )
      }
    })

  }



