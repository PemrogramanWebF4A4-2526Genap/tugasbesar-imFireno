@extends('layout.seller')

@section('title', 'Laporan Penjualan')
@section('MenuActiveLaporan', 'bg-emerald-50 text-emerald-600')

@section('content')
    @livewire('seller.laporan.index')
@endsection
