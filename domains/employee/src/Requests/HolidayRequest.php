<?php

namespace SkylarkSoft\HoneyComb\Employee\Requests;


use Illuminate\Foundation\Http\FormRequest;


class HolidayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'holiday'=> ['required'],
            'date'=>['required'],
            'end_date'=>['required'],
        ];
    }

}
