<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeSheetStoreRequest extends FormRequest
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
            'user_id'     => 'required|exists:users,id',
            'job_id'      => 'required|exists:users,id',
            'shift_id'    => 'required|exists:users,id',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
            'start_break' => 'string|nullable',
            'end_break'   => 'string|nullable',
        ];
    }
}
