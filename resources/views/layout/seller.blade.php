<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller Dashboard')</title>

    @include('layout.style')
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">

    @include('layout.seller._sidebar')

    <!-- Content -->
    <main class="flex-1 ml-64">

        <!-- Top Header -->
        <div class="bg-white border-b border-gray-200 px-8 py-4 sticky top-0 z-10">

            <div class="flex justify-between items-center">
        
                <div>
        
                    <h2 class="text-xl font-bold text-gray-900">
                        @yield('title')
                    </h2>
        
                </div>
        
                <div class="flex items-center gap-4">
        
                    <!-- Notification -->
                    <div class="relative">
                        @livewire('notifications')
                    </div>
        
                    <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
        
                        <img
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=10b981&color=fff"
                            class="w-10 h-10 rounded-full">
        
                        <div>
        
                            <h4 class="font-semibold text-gray-900 text-sm">
                                {{ auth()->user()->name }}
                            </h4>
        
                            <p class="text-xs text-gray-500">
                                Penjual
                            </p>
        
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </div>

        <!-- Page Content -->
        <div class="p-8">
            @yield('content')
        </div>

    </main>

</div>

@livewireScripts
@livewire('edit-profile')
</body>
</html>
