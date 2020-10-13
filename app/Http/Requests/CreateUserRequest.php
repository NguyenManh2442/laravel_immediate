<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'mail_address' => 'email|unique:users|max:100',
            'address' => 'required|max:255',
            'phone' => 'required|numeric|digits_between:9,15',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
