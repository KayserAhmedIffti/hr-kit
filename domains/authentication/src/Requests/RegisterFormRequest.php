<?php

namespace SkylarkSoft\HoneyComb\Authentication\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name'=> ['required'],
            'last_name'=>['required'],
            'email'=>['required'],
            'password'=>['required','confirmed','min:8'],
        ];
    }

}
