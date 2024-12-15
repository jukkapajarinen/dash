<?php

namespace App\Providers;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      $this->app->bind(UpdateUserPassword::class, function ($app) {
        return new class implements UpdatesUserPasswords {
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
        };
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
          $user = User::where('email', $request->email)->first();
   
          if ($user &&
              Hash::check($request->password, $user->password)) {
              return $user;
          }
        });

        Fortify::loginView(function () {
          return view('auth.login');
        });

        Fortify::twoFactorChallengeView(function () {
          return view('auth.challenge');
        });

        Fortify::confirmPasswordView(function () {
            return view('auth.confirmation');
        });
        
    }
}
