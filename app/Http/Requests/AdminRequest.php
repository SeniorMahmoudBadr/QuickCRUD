<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
    public bool $isUpdateRequest = false;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $user = auth()->user();
        $myRole = $user->role;

        if($myRole->user_role === 2){
            $this->merge([
                'governorate_id' => $user->governorate_id
            ]);
        }elseif($myRole->user_role === 3){
            $this->merge([
                'governorate_id' => $user->governorate_id,
                'directorate_id' => $user->directorate_id
            ]);
        }
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
            'governorate_id' => [Rule::requiredIf(in_array($role->user_role,[2,3,4])), 'exists:governorates,id'],
            'directorate_id' => [Rule::requiredIf(in_array($role->user_role,[3,4])), 'exists:directorates,id'],
            'health_unit_id' => [Rule::requiredIf(in_array($role->user_role,[4])), 'exists:health_units,id'],
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
