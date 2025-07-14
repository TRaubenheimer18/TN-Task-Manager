@extends('layouts.base')

@section('content')
    <h2 class="text-2xl font-semibold text-pink-700 mb-4">Dashboard</h2>
    <p>Welcome back, {{ Auth::user()->name }}!</p>
@endsection
