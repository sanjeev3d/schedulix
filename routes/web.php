 <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(!empty(Auth::id())){
        return redirect('/home'); 
    } else {
     return view('userslogin.login'); 
    }
});
    
    //Route::get('/{business_id}/appointment','Front\AppointmentController@forAllUser')->name('appointment.forAllUser');
    
//Auth::routes();

 /*------------------------userlogin controller--------------------------------*/
    Route::get('/register','LoginController@registerform')->name('userregister');
    Route::post('/register','LoginController@register')->name('post-register');
    Route::get('/login','LoginController@loginform')->name('userlogin');
    Route::post('/login','LoginController@login')->name('all-login');
    Route::get('/verify','LoginController@verify')->name('userverify');
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    /* forgot password */
    Route::get('/forgot-password','ForgotPasswordController@forgotPassword')->name('forgot.password');
    Route::get('/create-password','ForgotPasswordController@createPassword')->name('create.password');
    Route::post('/make-password','ForgotPasswordController@makePassword')->name('make.password');
    /* forgot password */
    
    Route::get('password/reset/{token}', 'ResetPasswordController@resetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::any('/verify-account','LoginController@verifyaccount')->name('verify-account');

    Route::post('/logout','LoginController@userLogout')->name('logout');


$router->group(['middleware' => ['auth','BusinessLoginCheck']], function() {
    Route::get('/home', 'HomeController@index')->name('home'); 
    // lots of routes that require auth middleware
    Route::post('/main_category_service', 'HomeController@main_category_service')->name('main_category_service');
    Route::post('/step_one', 'HomeController@step_one')->name('step_one');
    Route::post('/step_two', 'HomeController@step_two')->name('step_two'); 
    Route::post('/step_three', 'HomeController@step_three')->name('step_three');
    Route::post('/step_four', 'HomeController@step_four')->name('step_four');
    Route::post('/step_four_ajax', 'HomeController@step_four_ajax')->name('step_four_ajax'); 
    Route::post('/step_five', 'HomeController@step_five')->name('step_five'); 
    Route::post('/step_six', 'HomeController@step_six')->name('step_six'); 
    Route::post('/findstep', 'HomeController@findstep')->name('findstep'); 

    /*  Common Routes */
    Route::match(['get', 'post'],'delete/item', 'CommonController@delete')->name('admin.delete');
    /* Customer Filtered Record Route */
    Route::post('/searchrecord', 'HomeController@searchRecord')->name('searchrecord');
    
    Route::group(['namespace'=>'Front'],function() {

        /*  Customer Routes*/
        Route::any('/customers','CustomerController@customerList')->name('customerList');
        Route::get('/customers/exports','CustomerController@export')->name('customers.exports');
        Route::any('/customers/data','CustomerController@customerData')->name('customer.list');
        Route::post('/addCustomer', 'CustomerController@addCustomer')->name('addCustomer'); 
        Route::post('/editCustomer/{customers}', 'CustomerController@editCustomer')->name('editCustomer'); 
        Route::post('/updateCustomer/{customers}', 'CustomerController@updateCustomer')->name('updateCustomer'); 

        /* Appointment Calendar */
        Route::get('appointment/{id?}','AppointmentController@index')->name('appointment.calendar');
        Route::post('/addAppointment/{id?}', 'AppointmentController@addAppointment')->name('addAppointment');
        Route::get('/deleteAppointment', 'AppointmentController@destroyAppointment')->name('deleteAppointment');
        Route::post('/customer-suggestion', 'AppointmentController@getCustomerList')->name('getCustomerList');
        Route::post('/getCustomerDetail', 'AppointmentController@getCustomerDetail')->name('getCustomerDetail');
        Route::get('autocomplete', 'AppointmentController@autocomplete')->name('autocomplete');
        /* Appointment Datatable*/
        Route::post('/appointment/data','AppointmentController@appointmentData')->name('appointment.list');
       // Route::post('/appointment/{id}', 'AppointmentController@editAppointment')->name('editAppointment'); 

    });

    /*BusinessDetails Controller*/
    Route::resource('/business_details', 'BusinessDetailsController');
    Route::post('country', 'BusinessDetailsController@Country')->name('Country');
    Route::post('state', 'BusinessDetailsController@State')->name('State');

    /*BusinessTiming Controller*/
    Route::resource('/business_timing', 'BussinessTimingController');

    /*services Controller*/
    Route::get('/services', 'ServicesController@index'); 
    Route::post('/services/store', 'ServicesController@store')->name('services.store'); 
    Route::post('/services/create', 'ServicesController@create')->name('services_create.create');
    Route::get('/services/destroy/{id}', 'ServicesController@destroy')->name('services_delete.destroy');
   
    /*Staff Controller*/
    Route::resource('/staff', 'StaffController'); 
    Route::post('/staff/store', 'StaffController@store')->name('staff_create.store');
    Route::post('/staff/destroy', 'StaffController@destroy')->name('staff_delete.destroy');

    /*Staff Controller*/
    Route::resource('/privacy', 'PrivacyController'); 

});


/* customer role basis check route*/

Route::group(['middleware'=>'auth'],function(){

    Route::get('/home', function () {
        if(!empty(Auth::user()->role_id==5)){
            return redirect('/appointment'); 
        }else{
            return redirect('/home');
        } 
    });
    Route::get('/home', 'HomeController@index')->name('home'); 

    /*  Common Routes */
    Route::match(['get', 'post'],'delete/item', 'CommonController@delete')->name('admin.delete');

    Route::group(['namespace'=>'Front',['middleware' =>['CustomerLoginCheck']]],function() {
        /* Appointment Calendar */
        Route::get('appointment/{id?}','AppointmentController@index')->name('appointment.calendar');
        Route::post('/addAppointment/{id?}', 'AppointmentController@addAppointment')->name('addAppointment');
        Route::get('/deleteAppointment', 'AppointmentController@destroyAppointment')->name('deleteAppointment');
        Route::post('/customer-suggestion', 'AppointmentController@getCustomerList')->name('getCustomerList');

        Route::post('/get-services/{id?}', 'AppointmentController@getServices')->name('getServices');
        Route::post('/get-slots', 'AppointmentController@getTimeSlots')->name('getTimeSlots');
        Route::post('/appointment/data','AppointmentController@appointmentData')->name('appointment.list');
        // Route::post('/getCustomerDetail', 'AppointmentController@getCustomerDetail')->name('getCustomerDetail');
        // Route::get('autocomplete', 'AppointmentController@autocomplete')->name('autocomplete');
    });

});

    Route::post('/getCustomerDetail', 'Front\AppointmentController@getCustomerDetail')->name('getCustomerDetail');
    Route::get('autocomplete', 'Front\AppointmentController@autocomplete')->name('autocomplete');
    Route::get('{business_id?}/appointment','Front\AppointmentController@index')->name('appointment.calendar');
    Route::post('/get-slots', 'Front\AppointmentController@getTimeSlots')->name('getTimeSlots');
    Route::post('/get-services/{id?}', 'Front\AppointmentController@getServices')->name('getServices');
    Route::post('/addAppointment/{id?}', 'Front\AppointmentController@addAppointment')->name('addAppointment');