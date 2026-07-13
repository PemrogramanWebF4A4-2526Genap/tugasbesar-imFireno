@extends('layout.pembeli.keranjang')

@section('title', 'Keranjang - JasaMarket')

@section('FloatingActiveKeranjang', 'bg-emerald-100 text-green-700')
@section('content')
<div class="container mx-auto px-6 py-12">
    @livewire('pembeli.keranjang.index')
</div>
@endsection
