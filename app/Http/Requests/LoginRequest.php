<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name' => [
                'required', 'min:3',
                'exists:users,user_name',
                new \App\Rules\IsVerified,
                new \App\Rules\IsUserActive,
                new \App\Rules\IsAppActive,
            ],
            'password' => [
                'required', 'min:8',
                new \App\Rules\AuthenticateUser($this->input('user_name')),
                new \App\Rules\StrongPassword,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_name.exists' => 'Please check the User Name. It does not exist in our system.',
        ];
    }
}
