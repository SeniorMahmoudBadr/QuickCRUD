<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PermissionRequest extends FormRequest
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
            'guard_name' => 'web'
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = '';
        $Page = Page::find(request()->page_id);
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = Str::afterLast($this->getPathInfo(),'/');
        }
        return [
            'name' => ['required','starts_with:'.$Page->route.'-', 'unique:permissions,name,' . $id],
            'guard_name' => ['required', 'in:web'],
            'type' => ['required','in:get,post,put,patch,delete'],
            'has_params' => ['required','boolean'],
            'method' => ['required']
        ];
    }
}
