<?php

namespace SkylarkSoft\HoneyComb\Employee\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {

        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'employee_id' => ['required'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'dob' => ['required'],
            'n_id' => ['required'],
            'mobile' => ['required'],
            'religion' => ['required'],
            'nominee' => ['required'],
            'spouse' => ['required'],
           
        ];
    }
}
