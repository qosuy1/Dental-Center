<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class SpecialCaseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'patient_age' => ['required', 'numeric', 'min:1', 'max:99'],
            'treatment_duration' => ['required'],
            'procedures' => ['required'],
            'overview' => ['required'],
            'treatment_plan' => ['required'],
            'feedback' => ['nullable', 'string'],
            'result' => ['required'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'before_image' => [$this->isMethod('PUT') ? 'nullable' : 'required'],
            'after_image' => [$this->isMethod('PUT') ? 'nullable' : 'required'],

            'is_special_case' => ['min:0', 'max:2'],
            // 'is_special_case' => ['boolean'],

        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'the :attribute field is requierd'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'doctor_id' => "Doctor",
        ];
    }


}
