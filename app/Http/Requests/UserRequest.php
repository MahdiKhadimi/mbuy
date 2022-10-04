<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'email'=>'require|email|unique:users,email',
            'password'=>'required|confirmed|min:4'
        ];
    }

    public function messages()
    {
        return [
            '*.required'=>'The :attribute field conn\'nt be empty',
        ];
    }
}