<?php

namespace SkylarkSoft\HoneyComb\Employee\Requests;


use Illuminate\Foundation\Http\FormRequest;


class LeaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'leave_type'=> ['required'],
            'start_date'=>['required'],
            'end_date'=>['required'],
        ];
    }

}
