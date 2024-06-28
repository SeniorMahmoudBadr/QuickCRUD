<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
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
        $page = getCachedPages()->where('route',request()->segment(2))->first();
        $role = Role::find($page->role_id);
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'password' => ['nullable', Rule::requiredIf($this->isMethod('POST')), 'min:6', 'max:255', 'confirmed'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->route('id')],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = data_get($this->validator->validated(), $key, $default);

        if (!$this->isMethod('POST') && !$this->password)
            unset($validated['password']);

        return $validated;
    }
}
