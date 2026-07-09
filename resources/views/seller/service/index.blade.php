@extends('layout.seller')

@section('title', 'Jasa Saya')

@section('MenuActiveService', 'bg-emerald-50 text-emerald-600')

@section('content')
    @livewire('seller.service.index')
@endsection
