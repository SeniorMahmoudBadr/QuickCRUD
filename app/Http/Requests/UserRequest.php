<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public bool $isUpdateRequest = false;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $this->isUpdateRequest = $this->isMethod('PUT') || $this->isMethod('PATCH');
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->route('id')],
            'password' => ['nullable', Rule::requiredIf(! $this->isUpdateRequest), 'min:6', 'max:255', 'confirmed'],

        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = data_get($this->validator->validated(), $key, $default);

        if ($this->isUpdateRequest && ! $this->password)
            unset($validated['password']);

        return $validated;
    }
}
