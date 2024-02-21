@extends('layouts.app')

@section('content')
    <div class="mt-5">
        <div class="container">
            <h3 class="fs-3 fw-4 text-secondary">Our Products</h3>
            <div class="row">
                <div class="col-md-3 bg-light rounded py-3">
                    <form action="{{ route('products.filter') }}" method="GET">
                        <!-- Brands filter -->
                        <h5 class="text-secondary">Brands</h5>
                        <hr>
                        @forelse ($brands as $brand)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="brands[]"
                                    {{ isset($selectedBrands) && in_array($brand->name, $selectedBrands) ? 'checked' : '' }}
                                    value="{{ $brand->name }}" id="brand_{{ $brand->name }}">
                                <label class="form-check-label" for="brand_{{ $brand->name }}">
                                    {{ $brand->name }}
                                </label>
                            </div>
                        @empty
                            <div>
                                <p class="text-secondary">No brands found in this category.</p>
                            </div>
                        @endforelse

                        <!-- Price filter -->
                        @if ($products->count() > 0)
                            <div class="mt-4">
                                <h5 class="text-secondary">Price</h5>
                                <hr>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="price_order" value="asc"
                                        id="price_asc" {{ isset($priceOrder) && $priceOrder == 'asc' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="price_asc">
                                        Low to high
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="price_order" value="desc"
                                        id="price_desc" {{ isset($priceOrder) && $priceOrder == 'desc' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="price_desc">
                                        High to low
                                    </label>
                                </div>
                            </div>
                        @endif

                        <!-- Submit button -->
                        @if ($products->count() > 0)
                            <div class="mt-5 row px-3 g-2">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-warning text-light w-100"
                                        href="{{ '/categories/' . $products[0]->category->slug }}">Clear Filters</a>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="col-md-9 ps-3">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-4 mb-5">
                                <a href="{{ '/categories/' . $product->category->slug . '/' . $product->slug }}">
                                    <img src="{{ asset($product->productImages[0]->image) }}" width="100%" height="250px"
                                        alt="">
                                </a>
                                <div>
                                    <h5 class="mt-3 text-dark">@currency($product->price)</h5>
                                    <a href="{{ '/categories/' . $product->category->slug . '/' . $product->slug }}">
                                        <p class="m-0 fw-bold">{{ $product->name }}</p>
                                    </a>
                                    <p class="m-0">{{ $product->small_description }}</p>
                                </div>
                            </div>
                        @empty
                            <div>
                                <p class="fs-4 fw-bold text-secondary text-center">This category have no products.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
