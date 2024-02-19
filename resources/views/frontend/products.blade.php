@extends('layouts.app');

@section('content')
    <div class="h-100 mt-5">
        <div class="container">
            <h3 class="fs-3 fw-4 text-secondary">Our Products</h3>
            <div class="row">
                <div class="col-md-3 bg-light rounded py-3">
                    <div>
                        <h5 class="text-secondary">Brands</h5>
                        <hr>
                        @forelse ($brands as $brand)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $brand->name }}
                                </label>
                            </div>
                        @empty
                        <div>
                            <h5 class="text-secondary">This category have no brands yet.</h5 class="text-secondary">
                        </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        <h5 class="text-secondary">Price</h5>
                        <hr>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Low to high
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                High to low
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 ">
                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-md-4">
                            <a href="{{ Request::url() . '/' . $product->slug }}">
                                <img src="{{ asset($product->productImages[0]->image) }}" width="100%" height="250px" alt="">
                            </a>
                            <a class="text-decoration-none" href="">
                                <h4 class="mt-3 text-dark">{{ $product->name }}</h4>
                            </a>
                        </div>
                        @empty
                            <div>
                                <h2 class="text-secondary text-center">This category have no products yet.</h2>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
