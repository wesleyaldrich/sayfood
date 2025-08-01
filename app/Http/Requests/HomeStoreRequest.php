<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class HomeStoreRequest extends FormRequest
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
            'phoneNumber' => [
                'required',
                'numeric',
                'digits_between:10,15'
            ],
            'event_id' => [
                'required',
            ]
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $event = Event::find($this->event_id);

        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', true)
                ->with('modal_data', [
                    'title' => $event->name ?? '',
                    'host' => $event->creator?->user?->username ?? '',
                    'location' => $event->location ?? '',
                    'date' => $event->date ?? '',
                ])
        );
    }
}
