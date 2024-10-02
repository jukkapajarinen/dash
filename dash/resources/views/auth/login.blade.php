<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
      <h1>Login</h1>
      <form method="POST" action="{{ url('login') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
      </form>

      @if($errors->any())
        <div>
          <strong>Error!</strong> Invalid credentials.
        </div>
      @endif
    </body>
</html>
