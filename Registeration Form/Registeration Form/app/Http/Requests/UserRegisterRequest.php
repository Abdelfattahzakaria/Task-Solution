<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'photo' => 'required|mimes:jpg,jpeg,png|size:2024',  
            'fname' => 'required|max:50', 
            'lname' => 'required|max:50', 
        ];
    }
    public function messages(){

        return [
            'photo.required'=> 'please select a photo', 
            'photo.mimes'=> 'only allowed jpg , jpeg , png', 
            'fname.required'=> 'first name is required', 
            'lname.required'=> 'last name is required',
        ];
    }
}

  

