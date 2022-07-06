<?php

namespace SkylarkSoft\HoneyComb\Authentication\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'=>['required'],
            'password'=>['required'],
        ];
    }

}
