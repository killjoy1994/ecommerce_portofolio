@extends('layouts.app');

@section('content')
    <div class="h-100">
        <div class="container">
            <h3 class="fs-2 fw-4">Trending Products</h3>
            <div class="mt-4 row">
                @foreach ($trendings as $product)
                <div class="col-md-3">
                    <div class="position-relative">
                        <a href="{{ '/categories/' . $product->category->slug . '/' . $product->slug }}">
                            <img src="{{ asset($product->productImages[0]->image) }}" height="200px"
                                alt="">
                        </a>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            <h5 class="mt-3 text-dark">@currency($product->price)</h5>
                            <a href="{{ '/categories/' . $product->category->slug . '/' . $product->slug }}">
                                <p class="m-0 fw-bold">{{ $product->name }}</p>
                            </a>
                            <p class="m-0">{{ $product->small_description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection