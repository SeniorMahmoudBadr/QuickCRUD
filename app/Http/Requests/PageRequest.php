<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name_en' => ['required', 'string', 'max:255', 'unique:pages,name_en,' . $id],
            'name_ar' => ['required', 'string', 'max:255', 'unique:pages,name_ar,' . $id],
            'route' => ['required', 'unique:pages,route,' . $id, 'regex:/^([a-zA-Z])*$/'],
            'controller' => ['required', 'regex:/^([a-zA-Z])*$/'],
            'blade' => ['required', 'regex:/^([a-zA-Z])*$/'],
            'javascript' => ['required', 'regex:/^([a-zA-Z])*$/'],
            'display' => ['required', 'in:show,hide'],
            'position' => ['nullable', 'required_if:display,show', 'in:top,left'],
            'role_editable' => ['required', 'boolean'],
            'role_id' => ['nullable', 'exists:roles,id','unique:pages,role_id,' . $id],
            'sort' => ['nullable', 'required_if:display,show', 'integer', 'min:1'],
            'relatedPageContainer' => ['array'],
            'relatedPageContainer.*.child_id' => ['nullable', 'exists:pages,id'],
            'relatedPageContainer.*.btn_color' => ['nullable', 'required_with:role_editable.*.child_id', 'in:light,primary,secondary,success,info,warning,danger,dark'],
            'relatedPageContainer.*.type' => ['nullable', 'required_with:role_editable.*.child_id', 'in:modal,route'],
            'relatedPageContainer.*.into_btn_action' => ['nullable', 'required_with:role_editable.*.child_id', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name_en' => __('app.English Name'),
            'name_ar' => __('app.Arabic Name'),
            'role_id' => __('app.Role')
        ];
    }
}
