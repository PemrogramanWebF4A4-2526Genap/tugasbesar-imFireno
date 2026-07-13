@extends('layout.master')

@section('title', 'Home - JasaMarket')

@section('FloatingActiveHome', 'bg-emerald-100 text-green-700')
@section('content')
<div class="container mx-auto px-6 py-12">
    @livewire('all-services')
</div>
@endsection
