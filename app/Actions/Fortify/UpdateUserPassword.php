<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
      Validator::make($input, [
          'current_password' => ['required'],
          'password' => ['required', 'string', 'min:8'],
          'password_confirmation' => ['required', 'string', 'min:8'],
      ])->after(function ($validator) use ($user, $input) {
          if (! Hash::check($input['current_password'], $user->password)) {
            $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
          }
      })->validate();

      $user->forceFill([
          'password' => Hash::make($input['password']),
      ])->save();
    }
}
