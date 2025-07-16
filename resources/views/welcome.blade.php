<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome | Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Tailwind CSS for Styling -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <div class="text-center">
            <h1 class="text-3xl font-semibold mb-6 text-gray-900">Welcome to IRIS</h1>
            <p class="text-lg text-gray-700 mb-4">Please log in or register to access the dashboard and more.</p>
            <div class="flex flex-col items-center">
                <!-- Redirect Buttons -->
                @guest
                    <a href="{{ route('login') }}" class="inline-block px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors mb-4">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="inline-block px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Register
                    </a>
                @endguest
            </div>
        </div>
    </body>
</html>