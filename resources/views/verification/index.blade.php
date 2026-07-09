<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="py-4 md:py-8">

        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-[250px] h-[250px]" src="{{ asset('images/logojasamarket.png') }}">
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Verify your account
                    </h1>

                    @if(session('failed')){
                        <div class="alert">{{ session('failed') }}</div>
                        }
                    @endif

                    <p class="text-gray-100">Please check your email for the verification code.</p>
                    <form action="/verify" method="POST">
                        @csrf      
                        <input type="hidden" value="register" name="type">
                        <button type="submit" class="text-blue-600 hover:underline hover:bg-gray-100">Send OTP to your email</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
    @include('sweetalert::alert')
</body>

</html>
