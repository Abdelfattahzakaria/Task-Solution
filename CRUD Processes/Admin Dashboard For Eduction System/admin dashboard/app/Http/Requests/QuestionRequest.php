<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'answers' => 'required',
            'right_answer' => 'required',
            'quizze_id' => 'required',
            'score' => 'required',
        ];  
    } 
    public function messages()
    {
        return [
            'title.required' => trans('validation.required'),
            'answers.required' => trans('validation.unique'),
            'right_answer.required' => trans('validation.required'),
            'quizze_id.required' => trans('validation.required'),
            'score.numeric' => trans('validation.numeric'),
        ];
    } 
}
