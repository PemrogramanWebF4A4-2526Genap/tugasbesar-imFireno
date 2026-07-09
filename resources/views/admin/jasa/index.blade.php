@extends('layout.admin')

@section('title', 'Jasa Management')
@section('MenuActiveJasa', 'bg-slate-700 text-white')

@section('content')
    @livewire('admin.jasa.index')
@endsection