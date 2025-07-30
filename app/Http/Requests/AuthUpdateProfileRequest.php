<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AuthUpdateProfileRequest extends FormRequest
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
            'username' => 'required|string|max:64',
            'dob' => [
                'nullable',
                'date',
                'before_or_equal:' . Carbon::now()->subYears(18)->toDateString(), // at least 18
                'after_or_equal:' . Carbon::now()->subYears(125)->toDateString(), // at most 125
            ],
            'address' => 'nullable|string|max:200'
        ];
    }
}
