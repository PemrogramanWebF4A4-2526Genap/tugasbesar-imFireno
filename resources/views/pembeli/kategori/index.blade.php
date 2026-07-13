<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Jasa - JasaMarket</title>
    @include('layout.style')
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    @include('layout._navbar')

    <div class="min-h-screen">
        <div class="pt-24 pb-32 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:pembeli.kategori />
        </div>
    </div>
    
    <!-- Floating Bar -->
    @section('FloatingActiveKategori', 'bg-emerald-100 text-green-700')
    @include('layout._floatingbar')
    
    @include('layout.script')
    @livewireScripts
    @include('layout._livewire-sweetalert')
</body>
</html>
