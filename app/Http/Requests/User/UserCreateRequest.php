<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $fullName
 * @property $phoneNumber
 */
class UserCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'unique:users', 'regex:/^[+]7[0-9]{10}$/'],
            'password' => ['required', 'string', 'confirmed', 'min:6', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[$%&!:]).{6,}$/']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'full_name' => $this->fullName,
            'phone_number' => $this->phoneNumber
        ]);
    }
}
