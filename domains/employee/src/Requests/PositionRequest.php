<?php

namespace SkylarkSoft\HoneyComb\Employee\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        return [
            'name'=> ['required'],
            'name_bn'=> ['required'],
            'status'=> ['required'],

        ];
    }

}
