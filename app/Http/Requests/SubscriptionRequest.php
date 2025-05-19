<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SubscriptionRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'email' => 'required|email',
            'city' => 'required|string|exists:cities,name',
            'frequency' => 'required|in:hourly,daily',
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'city.exists' => 'The selected city is not available',
            'frequency.in' => 'Frequency must be hourly or daily',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response(null, 400)
        );
    }
}
