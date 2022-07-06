<?php

namespace App\Actions\Fortify;

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
            'fName' => ['required', 'string', 'max:255'],
            'midInit' => ['required', 'string', 'max:255'],
            'lName' => ['required', 'string', 'max:255'],
            'stud_num' => ['required', 'string', 'max:255'],
            'yrLvl' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'fName' => $input['fName'],
                'midInit' => $input['midInit'],
                'lName' => $input['lName'],
                'stud_num' => $input['stud_num'],
                'yrLvl' => $input['yrLvl'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'email' => $input['email'],
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
            'fName' => $input['fName'],
            'midInit' => $input['midInit'],
            'lName' => $input['lName'],
            'stud_num' => $input['stud_num'],
            'yrLvl' => $input['yrLvl'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
