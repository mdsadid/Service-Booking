<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name'        => $this->input('name') ? trim($this->input('name')) : null,
            'description' => $this->input('description') ? trim($this->input('description')) : null,
            'price'       => $this->input('price') ? trim($this->input('price')) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $serviceId = $this->isMethod('PUT') ? $this->route('service')->id : null;

        return [
            'name'        => "required|string|max:255|unique:services,name,$serviceId",
            'description' => 'required|string|min:10',
            'price'       => 'required|numeric|gt:0',
            'status'      => 'required|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'This service already exists.'
        ];
    }
}
