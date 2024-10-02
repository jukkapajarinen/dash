<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
      <h1>Welcome</h1>
      <hr>
      <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
        @csrf
        @if(auth()->user()->two_factor_secret)
          Two factor authentication is enabled.
          <h2>QR Code for authenticator applications</h2>
          <div>
            {!!  auth()->user()->twoFactorQrCodeSvg() !!}
          </div>
          <h2>Recovery codes</h2>
          <ul>
            @foreach(auth()->user()->recoveryCodes() as $code)
              <li>{{ $code }}</li>
            @endforeach
          </ul>
          @method('DELETE')
          <button type="submit">Disable</button>
        @else
          Two factor authentication is not enabled.
          <button type="submit">Enable</button>
        @endif
      </form>
      <hr>
      <form method="POST" action="{{ url('/user/password') }}">
        @csrf
        @method('PUT')
        <div>
          <label for="current_password">Current Password</label>
          <input id="current_password" type="password" name="current_password" required>
          @error('current_password')
            <strong>{{ $message }}</strong>
          @enderror
        </div>
        <div>
          <label for="password">New Password</label>
          <input id="password" type="password" name="password" required>
          @error('password')
            <strong>{{ $message }}</strong>
          @enderror
        </div>
        <div>
          <label for="password_confirmation">Confirm New Password</label>
          <input id="password_confirmation" type="password" name="password_confirmation" required>
          @error('password_confirmation')
            <strong>{{ $message }}</strong>
          @enderror
        </div>
        <button type="submit">Update Password</button>
        @if (session('status') === 'password-updated')
          <div>
            Password updated successfully.
          </div>
        @endif
      </form>
      <hr>
      <form method="POST" action="{{ url('logout') }}">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </body>
</html>
