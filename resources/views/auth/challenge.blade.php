<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyLaravel</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-sm bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Two-Factor Challenge</h1>
        <p class="text-gray-600 text-center mb-6">Please enter your authentication code to login.</p>

        <!-- Two-Factor Authentication Form -->
        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf
            <!-- Code Input -->
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">Authentication Code</label>
                <input id="code" type="text" name="code" required class="mt-1 p-2 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('code')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Confirm Code
            </button>
        </form>

        <!-- Recovery Code Section -->
        <div class="mt-8">
            <p class="text-gray-600 text-center mb-6">Or, enter your recovery code.</p>

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf
                <!-- Recovery Code Input -->
                <div class="mb-4">
                    <label for="recovery_code" class="block text-sm font-medium text-gray-700">Recovery Code</label>
                    <input id="recovery_code" type="text" name="recovery_code" required class="mt-1 p-2 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('recovery_code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Confirm Code
                </button>
            </form>
        </div>
    </div>
</body>
</html>
