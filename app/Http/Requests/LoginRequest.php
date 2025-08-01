<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UserNameExists;
use App\Rules\IsVerified;
use App\Rules\IsAppActive;
use App\Rules\IsUserActive;
use App\Rules\AuthenticateUser;
use App\Rules\IsStrongPassword;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow anyone to make login request
    }

    public function rules()
    {
        // return [
        //     'user_name' => [
        //         'required',
        //         new UserNameExists,
        //         new IsVerified,
        //         new IsAppActive,
        //         new IsUserActive,
        //     ],
        //     'password' => [
        //         'required',
        //         new AuthenticateUser($this->input('user_name')),
        //         new IsStrongPassword,
        //     ]
        // ];
    }

    public function messages()
    {
        // return [
        //     'user_name.required' => 'User Name is required.',
        //     'password.required' => 'Password is required.',
        //     'password.authenticate_user' => 'Invalid login credentials.',
        // ];
    }
}
