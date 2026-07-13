<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @include('layout.style')
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">

    @include('layout.admin._sidebar')

    <!-- Content -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h2 class="text-3xl font-bold">
                    @yield('title')
                </h2>

                <p class="text-gray-500">
                    Selamat datang kembali
                </p>

            </div>

            <div class="flex items-center gap-3">

                <img
                    src="https://ui-avatars.com/api/?name=Admin"
                    class="w-12 h-12 rounded-full">

                <div>

                    <h4 class="font-semibold">
                        Administrator
                    </h4>

                    <p class="text-sm text-gray-500">
                        admin@jasamarket.com
                    </p>

                </div>

            </div>

        </div>

        @yield('_chartInfo')
        <!-- Table -->
        @yield('content')

    </main>

</div>

@include('layout.script')
@livewireScripts
@include('layout._livewire-sweetalert')
@livewire('edit-profile')
@stack('scripts')
</body>
</html>