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
            "shift_name"        => ["required", "string", "max:255"],
            "start_time"        => ["required", "string"],
            "end_time"          => ["required", "string"],
            "has_break"         => ["required", "boolean"],
            "break_type"        => ["required_if:has_break,1", "string", "nullable"],
            "break_duration"    => ["required_if:has_break,1", "integer", "nullable"],
            "total_hours"       => ["required", "string", "max:255"],
            "expected_earnings" => ["required", "integer"],
        ];
    }
}
