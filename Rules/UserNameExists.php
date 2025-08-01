<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;



class UserNameExists implements Rule
{
    public function passes($attribute, $value)
    {
        return 1;
    }

    public function message()
    {
        return 'Please check the User Name. It does not exist in our system.';
    }
}

