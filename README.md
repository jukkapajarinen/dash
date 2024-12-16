# Dash

Sane Laravel bare-bones 2FA setup. There is a login screen, 2FA challenge screen and a home screen.

## Commands

```
composer install;
cp .env.example .env;
php artisan key:generate;
php artisan migrate;
echo "\App\Models\User::create(['name' => 'tester', 'email' => 'tester@tester.com', 'password' => bcrypt('tester')]);" | php artisan tinker;
php artisan serve;
```

## Author

- [Jukka Pajarinen](https://www.jukkapajarinen.com)

## [License](LICENSE.md)

Copyright (c) 2024 Jukka Pajarinen

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
