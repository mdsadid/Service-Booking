<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name'     => $this->input('name') ? trim($this->input('name')) : null,
            'username' => $this->input('username') ? trim($this->input('username')) : null,
            'email'    => $this->input('email') ? mb_strtolower(trim($this->input('email'))) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'username' => 'required|string|alpha_dash:ascii|max:50|unique:users,username',
            'email'    => 'required|string|email:rfc,dns|max:255|unique:users,email',
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ];
    }
}
