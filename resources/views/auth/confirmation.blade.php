<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyLaravel</title>
    </head>
    <body>
      <h1>Confirm password</h1>
      <form method="POST" action="{{ url('/user/confirm-password') }}">
        @csrf
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Confirm password</button>
      </form>

      @if($errors->any())
        <div>
          <strong>Error!</strong> Invalid password.
        </div>
      @endif
    </body>
</html>
