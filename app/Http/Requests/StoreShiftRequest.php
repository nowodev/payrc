<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShiftRequest extends FormRequest
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
            "name"              => ["required", "string", "max:255"],
            "start_time"        => ["required", "string"],
            "end_time"          => ["required", "string"],
            "has_break"         => ["required", "boolean"],
            "break_type"        => ["required_if:break_type,1", "string", "nullable"],
            "break_duration"    => ["required_if:break_type,1", "integer", "nullable"],
            "start_break"       => ["required_if:break_type,1", "string", "nullable"],
            "end_break"         => ["required_if:break_type,1", "string", "nullable"],
            "total_hours"       => ["required", "integer", "max:255"],
            "expected_earnings" => ["required", "integer"],
        ];
    }
}
