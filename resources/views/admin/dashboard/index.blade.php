@extends('layout.admin')

@section('title', 'Dashboard Admin')
@section('MenuActiveDashboard', 'bg-slate-700 text-white')

@section('content')
    @livewire('admin.dashboard.index')
@endsection
