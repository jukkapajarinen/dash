<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyLaravel</title>
    </head>
    <body>
      <h1>Two factor challenge</h1>
      <h2>Please enter your authentication code to login.</h2>
      <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf
        <input id="code" type="code" name="code" required >
        @error('code')
        <div>
          <strong>Error:</strong> {{ $message }}
        </div>
        @enderror
        <button type="submit">Confirm Code</button>
      </form>

      <h2>Please enter your recovery code to login.</h2>
      <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf
        <input id="recovery_code" type="text" name="recovery_code" required >
        @error('recovery_code')
        <div>
          <strong>Error:</strong> {{ $message }}
        </div>
        @enderror
        <button type="submit">Confirm Code</button>
      </form>
    </body>
</html>
