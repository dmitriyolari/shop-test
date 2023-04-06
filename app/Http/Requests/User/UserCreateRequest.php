<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Rules\NewPasswordRule;
use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $fullName
 * @property $phoneNumber
 */
class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

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
            'phone_number' => ['required', 'numeric', 'unique:users', new PhoneNumberRule()],
            'password' => ['required', 'string', 'confirmed', 'min:6', new NewPasswordRule()]
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
