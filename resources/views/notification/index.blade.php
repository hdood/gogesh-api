@extends('layout')
@section('menu12_a1', 'menu-active')
@section('app', 'id=app')
@section('content')
    <notification :notifications="{{ $notifications }}" />
@endsection
