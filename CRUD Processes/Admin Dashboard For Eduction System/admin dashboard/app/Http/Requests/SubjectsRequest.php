<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',
            'teacher_id' => 'required',
        ];
    } 

    public function messages()
    {
        return [
            'Name_ar.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.unique'),
            'Grade_id.required' => trans('validation.required'),
            'Class_id.required' => trans('validation.required'),
            'teacher_id.numeric' => trans('validation.required'),             
        ];
    } 
}   
