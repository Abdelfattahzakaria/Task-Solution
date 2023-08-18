<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibraryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'Grade_id' => 'required',
            'section_id' => 'required',           
        ];
    } 

    public function messages()
    {
        return [
            'title.required' => trans('validation.required'),
            'Grade_id.required' => trans('validation.unique'),
            'section_id.required' => trans('validation.required'), 
        ];
    }  
}  
    