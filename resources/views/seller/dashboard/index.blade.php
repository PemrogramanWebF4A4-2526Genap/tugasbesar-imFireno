@extends('layout.seller')

@section('title', 'Dashboard')
@section('MenuActiveDashboard', 'bg-emerald-50 text-green-700')
@section('content')
    @livewire('seller.dashboard')
@endsection