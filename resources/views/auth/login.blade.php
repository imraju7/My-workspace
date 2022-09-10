<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @csrf
    <title>{{ $data['pageTitle'] }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset($data['favicon']) }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('auth/app.css') }}">
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <img src="{{ asset($data['logo']) }}" width="75px" height="50px" />
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('loginError'))
                    <div class="mb-4">
                        <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            <li> {{ session('loginError') }}</li>
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="mb-4">
                        <ul class="mt-3 list-disc list-inside text-sm text-green-600">
                            <li> {{ session('success') }}</li>
                        </ul>
                    </div>
                @endif
                @if (session('banned'))
                    <div class="mb-4">
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            <li> {{ session('banned') }}</li>
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="email">
                            Email
                        </label>
                        <input class="form-input rounded-md shadow-sm block mt-1 w-full" id="email" type="email"
                            name="email" value="{{ old('email') }}" placeholder="Your Email" autofocus="autofocus">
                    </div>
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="password">
                            Password
                        </label>
                        <input class="form-input rounded-md shadow-sm block mt-1 w-full" id="password" type="password"
                            name="password" autocomplete="current-password">
                    </div>
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        @if (session('banned'))
                            <a class="underline text-sm pr-4 text-gray-600 hover:text-gray-900"
                                href="mailto:{{ $data['email'] }}">
                                Contact Admin
                            </a>
                        @endif
                        <a class="underline text-sm pr-4 text-gray-600 hover:text-gray-900"
                            href="{{ route('register') }}">
                            Register ?
                        </a>
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('forgot.password.get') }}">
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
    {{-- <script src="{{ asset('auth/app.js') }}"></script> --}}
</body>

</html>
