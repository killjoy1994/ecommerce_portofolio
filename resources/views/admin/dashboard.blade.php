@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <h1>HALLO DASHBOARD</h1>
@endsection
