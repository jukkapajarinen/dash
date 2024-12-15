<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyLaravel</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-8 sm:px-12 lg:px-16 py-4 flex justify-between items-center">
            <a href="/" class="text-gray-800 text-2xl font-semibold">MyLaravel</a>
            <div class="space-x-4">
                <a href="/" class="text-gray-800 hover:text-indigo-600">Home</a>
                <form method="POST" action="{{ url('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <!-- Left-aligned User Dashboard Title -->
            <h1 class="text-2xl font-semibold text-gray-700 mb-6">Welcome {{ auth()->user()->name }}!</h1>

            <!-- Two-Factor Authentication Section -->
            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                @csrf

                @if(auth()->user()->two_factor_secret)
                    <div class="mb-6">
                        <p class="text-gray-700">Two-factor authentication is enabled.</p>
                        <h2 class="text-lg font-semibold mt-4">QR Code for Authenticator Apps</h2>
                        <div class="my-4">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        <h2 class="text-lg font-semibold mt-4">Recovery Codes</h2>
                        <ul class="list-disc pl-5">
                            @foreach(auth()->user()->recoveryCodes() as $code)
                                <li>{{ $code }}</li>
                            @endforeach
                        </ul>
                        <button type="submit" class="mt-6 bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Disable Two-Factor Authentication
                        </button>
                    </div>
                @else
                    <div class="mb-6">
                        <p class="text-gray-700">Two-factor authentication is not enabled.</p>
                        <button type="submit" class="mt-6 bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Enable Two-Factor Authentication
                        </button>
                    </div>
                @endif
            </form>

            <hr class="my-8">

            <!-- Password Update Section -->
            <form method="POST" action="{{ url('/user/password') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                    <input id="current_password" type="password" name="current_password" required class="mt-1 p-2 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('current_password')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input id="password" type="password" name="password" required class="mt-1 p-2 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-1 p-2 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password_confirmation')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Normal Width for Update Password Button -->
                <button type="submit" class="py-2 px-4 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Update Password
                </button>

                @if (session('status') === 'password-updated')
                    <div class="mt-4 text-center text-sm text-green-600">
                        Password updated successfully.
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
