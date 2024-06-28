<?php

namespace App\Http\Requests;

use App\Rules\RoleUnique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'guard_name' => 'web',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

    public function rules(): array
    {
        $roleId = $this->route('id');



        return [
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($roleId),
                new RoleUnique
            ],
            'guard_name' => [],
            'permission' => ['required', 'array'],
            'permission.*' => ['required', 'exists:permissions,id']
        ];
    }
}
