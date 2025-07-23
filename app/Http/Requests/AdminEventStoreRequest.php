<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminEventStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:1'
            ],
            'description' => [
                'required',
                'min:1'
            ],
            'date' => [
                'required',
                'date'
            ],
            'location' => [
                'required',
                'min:1'
            ],
            'event_category_id' => [
                'required',
            ],
            'status' => [
                'required'
            ],
            'group_link' => [
                'required'
            ],
            'image_url' => [
                'required',
                'mimes:png,jpg,jpeg',
                'max:2048'
            ]
        ];
    }
}
