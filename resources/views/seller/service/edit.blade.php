@extends('layout.seller')

@section('title', 'Edit Jasa')

@section('content')
    @livewire('seller.service.edit', ['id' => $id])
@endsection
