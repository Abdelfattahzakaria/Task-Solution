<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessingFeesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'Debit' => 'required',
            'final_balance' => 'required',
            'description' => 'required',
        ]; 
    }

    public function messages()
    {
        return [
            'Debit.required' => trans('validation.required'),
            'final_balance.required' => trans('validation.unique'),
            'description.required' => trans('validation.required'),
        ];
    }
}
   