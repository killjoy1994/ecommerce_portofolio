@extends('layouts.app');

@section('content')
    <div class="h-100">
        <div class="container">
            <h3 class="fs-2 fw-4">All Categories</h3>
            <div class="mt-4 row">
                @foreach ($categories as $category)
                    <div class="col-md-4 mb-5">
                        <a href="{{ Request::url() . '/' . $category->slug }}">
                            <img src="{{ asset('storage/category/'.$category->image) }}" width="100%" height="250px" alt="">
                        </a>
                        <a class="text-decoration-none" href="{{ Request::url() . '/' . $category->slug }}">
                            <h4 class="text-secondary bg-light py-3 text-center">{{ $category->name }}</h4>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection