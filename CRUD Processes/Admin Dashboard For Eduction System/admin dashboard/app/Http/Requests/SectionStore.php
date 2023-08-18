<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "Name" => "required",
            "Name_en" => "required",
            "Grade_id"=> "required",  
            "Class_id"=>"required", 
        ];
    }
    public function messages():array{
        return [
         "Name.required"=> trans("validation.required"),   
         "Name_en.required"=> trans("validation.required"), 
         "Grade_id.required"=> trans("validation.required"),   
         "Class_id.required"=> trans("validation.required"),   
        ];          
        }     
}  
