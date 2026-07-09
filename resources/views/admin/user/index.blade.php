@extends('layout.admin')

@section('title', 'User Management')
@section('MenuActiveUser', 'bg-slate-700 text-white')

@section('content')
    @livewire('admin.user.index')
@endsection
