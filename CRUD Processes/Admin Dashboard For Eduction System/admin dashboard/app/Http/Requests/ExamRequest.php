<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    public function rules()
    {
        return [
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'term' => 'required',
            'academic_year' => 'required',
        ];
    } 

    public function messages()
    {
        return [
            'Name_ar.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.unique'),
            'term.required' => trans('validation.required'),
            'academic_year.required' => trans('validation.required'),
        ];
    } 
}
   