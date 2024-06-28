<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RoleUnique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(request()->method() == 'POST' && getCachedPages()->where('route',$value)->first()) {
            $fail('لا يمكن انشاء وظيفة جديدة بهذا الاسم لانه مستخدم من قبل');
        }elseif(in_array(request()->method() ,['PUT','PATCH']) && getCachedPages()->where('route',$value)->where('role_id','!=',request()->route('id'))->first()) {
            $fail('لا يمكن تعديل اسم الوظيفة لهذا الاسم لانه مستخدم من قبل');
        }
    }
}
