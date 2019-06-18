<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'first_name' =>'required|max:25',
            'last_name' =>'required|max:25',
            'email' =>'required|unique:users,email',
            'address' =>'required|max:100',
            'country' =>'required',
            'city' =>'required',
            'region' =>'required',
            'zip_code' =>'required|digits:6',
            'home_phone' =>'required|digits:10',
            'mobile_phone' =>'required|digits:10',
            'work_phone' =>'required|digits:10',
        ];
    }

    public function messages() {
        return [
            'first_name.required'=>'name field required.',
            'first_name.max'=>'name must be 25 characters field required.',
            'last_name.required'=>'last name field required.',
            'last_name.size'=>'last name must be 25 characters field required.',
            'email.required'=>'email field required.',
            'email.unique'=>'email field must be unique.',
            'address.required'=>'address field required.',
            'address.size'=>'address must be 100 characters field required.',
            'country.required'=>'city field required.',
            'city.required'=>'region field required.',
            'region.required'=>'address field required.',
            'zip_code.required'=>'zip code field required.',
            'zip_code.digits'=>'zip code must  be 6 digits required.',
            'home_phone.required'=>'home phone field required.',
            'home_phone.digits'=>'home phone must be 10 digits .',
            'mobile_phone.required'=>'mobile phone field required.',
            'mobile_phone.digits'=>'mobile phone must be 10 digits required.',
            'work_phone.required'=>'work phone field required.',
            'work_phone.digits'=>'work phone must be 10 digits required .',
        ];
            
    }
}
