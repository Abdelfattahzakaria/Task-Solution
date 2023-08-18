<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStudentUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'Debit' => 'required',
            'description' => 'required',
        ];
    }   
    public function messages()
    {
        return [
            'Debit.required' => trans('validation.required'),
            'description.required' => trans('validation.unique'),
        ]; 
    }
}
    