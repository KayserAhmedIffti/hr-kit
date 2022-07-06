<?php

namespace SkylarkSoft\HoneyComb\Employee\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {

        return [
            'department_name' => ['required'],
            'department_bn' => ['required'],
            'status'=> ['required']
            
        ];
    }
}
