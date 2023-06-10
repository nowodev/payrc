<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            "company_name" => ["required", "string", "max:255"],
            "position"     => ["required", "string", "max:255"],
            "work_setting" => ["required", "string", "max:255"],
            "job_type"     => ["required", "string", "max:255"],
            "pay_rate"     => ["required", "string", "max:255"],
            "pay_time"     => ["required", "string", "max:255"],
        ];
    }
}
