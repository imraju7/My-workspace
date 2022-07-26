<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @csrf
    <title>{{ $pageTitle }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <img src="{{ asset($logo) }}" width="75px" height="50px" />
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="mb-4">
                    <div class="font-medium text-red-600">Whoops! Something went wrong.</div>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        <li>These credentials do not match our records.</li>
                    </ul>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="email">
                            Email
                        </label>
                        <input class="form-input rounded-md shadow-sm block mt-1 w-full" id="email" type="email"
                            name="email" value="bishalagriculture@gmail.com" required="required"
                            autofocus="autofocus">
                    </div>
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="password">
                            Password
                        </label>
                        <input class="form-input rounded-md shadow-sm block mt-1 w-full" id="password" type="password"
                            name="password" required="required" autocomplete="current-password">
                    </div>
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('forgot-password') }}">
                            Forgot your password?
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
