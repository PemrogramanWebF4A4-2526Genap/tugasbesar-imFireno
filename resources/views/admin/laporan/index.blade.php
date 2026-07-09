@extends('layout.admin')

@section('title', 'Laporan Management')
@section('MenuActiveLaporan', 'bg-slate-700 text-white')

@section('content')
    @livewire('admin.laporan.index')
@endsection