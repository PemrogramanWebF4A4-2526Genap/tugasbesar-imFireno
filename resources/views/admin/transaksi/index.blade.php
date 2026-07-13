@extends('layout.admin')

@section('title', 'Transaksi Jasa')
@section('MenuActiveTransaksi', 'bg-slate-700 text-white')

@section('content')
    @livewire('admin.transaksi.index')
@endsection
