@extends('layout.admin')

@section('title', 'Pesanan Management')
@section('MenuActivePesanan', 'bg-slate-700 text-white')

@section('content')
    @livewire('admin.pesanan.index')
@endsection