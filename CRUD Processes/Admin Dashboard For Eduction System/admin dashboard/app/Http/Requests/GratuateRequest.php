<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GratuateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "Grade_id" => "required",
            "Classroom_id" => "required",
            "section_id" => "required",
        ];
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function messages(): array
    {
        return [
            "Grade_id.required" => trans("validation.required"),
            "Classroom_id.required" => trans("validation.required"),
            "section_id.required" => trans("validation.required"),
        ];
    }
}
   