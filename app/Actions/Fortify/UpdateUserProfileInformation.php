<?php

namespace App\Actions\Fortify;

use App\Models\{
    User,
    Province,
    City
};
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{

    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:195'],
            'firstname' => ['required', 'string', 'max:195'],
            'lastname' => ['required', 'string', 'max:195'],
            'email' => ['required', 'email', 'max:195', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            //'province_id'  => ['nullable'],
            'city_id'  => ['nullable'],
            'role_id' => ['nullable'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                //'province_id'  => $input['province_id'],
                'city_id' => $input['city_id'],
                'role_id' => $input['role_id'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'email' => $input['email'],
            'email_verified_at' => null,
            //'province_id'  => $input['province_id'],
            'city_id' => $input['city_id'],
            'role_id' => $input['role_id'],
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
