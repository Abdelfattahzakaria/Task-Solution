<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    public function rules()
    {
        return [
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'section_id' => 'required',
        ];
    }  

    public function messages()
    {
        return [
            'Name_ar.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.unique'),
            'subject_id.required' => trans('validation.required'),
            'teacher_id.required' => trans('validation.required'),
            'Grade_id.required' => trans('validation.required'),
            'Classroom_id.required' => trans('validation.required'),
            'section_id.required' => trans('validation.required'),  
        ];
    }  
}  
