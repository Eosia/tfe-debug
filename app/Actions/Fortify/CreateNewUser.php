<?php

namespace App\Actions\Fortify;

use App\Models\{
    User,
    Province,
    City
};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;


class  CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:195'],
            'firstname' => ['required', 'string', 'max:195'],
            'lastname' => ['required', 'string', 'max:195'],
            'role_id'  => ['required'],
            //'province_id'  => ['required'],
            'city_id'  => ['required'],
            'email' => ['required', 'string', 'email', 'max:195', 'unique:users'],
            'password' => $this->passwordRules(),
            //'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id'  => $input['role_id'],
            //'province_id'  => $input['province_id'],
            'city_id' => $input['city_id'],
        ]);
    }
}
