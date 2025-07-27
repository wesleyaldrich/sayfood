<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_category_id' => ['required', Rule::exists('event_categories', 'id')],
            'status' => ['required', Rule::in(['Coming Soon', 'On Going', 'Completed', 'Pending', 'Canceled'])],
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'group_link' => 'required|url',
            'image_url' => 'required|image|max:2048',

            'start_hour' => 'required|integer|min:1|max:12',
            'start_minute' => 'required|integer|min:0|max:59',
            'start_ampm' => ['required', Rule::in(['AM', 'PM'])],
            'end_hour' => 'required|integer|min:1|max:12',
            'end_minute' => 'required|integer|min:0|max:59',
            'end_ampm' => ['required', Rule::in(['AM', 'PM'])],
        ];
    }

    /**
     * Get the custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The event name is required.',
            'description.required' => 'The description is required.',
            'date.after_or_equal' => 'The event date cannot be in the past.',
            'group_link.url' => 'The group link format is invalid. It must start with http:// or https://',
            'image_url.required' => 'An event image is required.',
            'image_url.image' => 'The uploaded file must be an image (e.g., jpg, png, bmp).',
            'image_url.max' => 'The image size cannot exceed 2MB.',

            'event_category_id.exists' => 'The selected category is invalid.',
            'status.in' => 'The selected status is invalid.',

            'required' => 'This field is required.',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            try {
                $start = Carbon::createFromFormat('g:i A', sprintf('%02d:%02d %s', $this->start_hour, $this->start_minute, $this->start_ampm));
                $end = Carbon::createFromFormat('g:i A', sprintf('%02d:%02d %s', $this->end_hour, $this->end_minute, $this->end_ampm));

                if ($end <= $start) {
                    $validator->errors()->add('end_hour', 'End time must be after the start time.');
                }
            } catch (\Exception $e) {
                $validator->errors()->add('start_hour', 'Invalid time format.');
            }
        });
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal', true)
        );
    }
}
