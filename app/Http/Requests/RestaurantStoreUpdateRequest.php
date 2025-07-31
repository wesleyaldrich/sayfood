<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class RestaurantStoreUpdateRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'exp_date' => 'required|date|after_or_equal:today',
            'exp_time' => 'required|date_format:H:i',
            'image_url' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => __('food_validation.name.required'),
            'name.max'          => __('food_validation.name.max'),
            'category_id.required' => __('food_validation.category_id.required'),
            'category_id.exists'   => __('food_validation.category_id.exists'),
            'description.required' => __('food_validation.description.required'),
            'exp_date.required' => __('food_validation.exp_date.required'),
            'exp_date.after_or_equal' => __('food_validation.exp_date.after_or_equal'),
            'exp_time.required' => __('food_validation.exp_time.required'),
            'exp_time.date_format'  => __('food_validation.exp_time.date_format'),
            'image_url.mimes'   => __('food_validation.image_url.mimes'),
            'image_url.max'     => __('food_validation.image_url.max'),
            'stock.required'    => __('food_validation.stock.required'),
            'stock.integer'     => __('food_validation.stock.integer'),
            'stock.min'         => __('food_validation.stock.min'),
            'price.required'    => __('food_validation.price.required'),
            'price.integer'     => __('food_validation.price.integer'),
            'price.min'         => __('food_validation.price.min'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal', $this->input('form_type'))
        );
    }
}
