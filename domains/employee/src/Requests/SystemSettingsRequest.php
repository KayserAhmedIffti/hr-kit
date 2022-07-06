<?php

namespace SkylarkSoft\HoneyComb\Employee\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        return [
            'name'=> ['required'],
            'address'=> ['required'],
            'file_path'=> ['required'],

        ];
    }

}
