<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class CustomerEventStoreRequest extends FormRequest
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
            'event_category_id' => 'required|integer|exists:event_categories,id',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'group_link' => 'nullable|url|max:255',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'files.*' => ['nullable', 'file', 'max:5120'], // per file max 5MB

            'estimated_participants' => ['required', 'integer', 'min:1'],
            'organizer_name' => ['required', 'string'],
            'organizer_email' => ['required', 'email'],
            'organizer_phone' => ['required'],
            'group_link' => ['required', 'url'],

            'start_hour' => ['required'],
            'start_minute' => ['required'],
            'start_ampm' => ['required'],
            'end_hour' => ['required'],
            'end_minute' => ['required'],
            'end_ampm' => ['required'],

            'agree_terms' => ['accepted'],
        ];
    }

    public function attributes(): array
    {
        return [
            'image_url' => 'image',
        ];
    }
    /**
     * Tambahan validasi kustom setelah rules() diproses.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            try {
                $start = Carbon::createFromFormat(
                    'g:i A',
                    sprintf('%02d:%02d %s', $this->start_hour, $this->start_minute, $this->start_ampm)
                );
                $end = Carbon::createFromFormat(
                    'g:i A',
                    sprintf('%02d:%02d %s', $this->end_hour, $this->end_minute, $this->end_ampm)
                );

                if ($end <= $start) {
                    $validator->errors()->add('end_hour', 'End time must be after start time.');
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
                ->with('show_modal', true) // Supaya modal tetap terbuka
        );
    }
}
