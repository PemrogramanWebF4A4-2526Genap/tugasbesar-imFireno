@extends('layout.admin')

@section('title', 'Seller Management')
@section('MenuActiveSeller', 'bg-slate-700 text-white')

@section('content')
    @livewire('admin.seller.index')
@endsection