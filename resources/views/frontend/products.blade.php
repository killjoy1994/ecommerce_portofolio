@extends('layouts.app')

@section('content')
    <div class="h-100 mt-5">
        <div class="container">
            <h3 class="fs-3 fw-4 text-secondary">Our Products</h3>
            <div class="row">
                <div class="col-md-3 bg-light rounded py-3">
                    <form action="{{ route('products.filter') }}" method="GET">
                        <!-- Brands filter -->
                        <h5 class="text-secondary">Brands</h5>
                        <hr>
                        @foreach ($brands as $brand)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="brands[]" {{ isset($selectedBrands) && in_array($brand->name, $selectedBrands) ? 'checked' : '' }} value="{{ $brand->name }}" id="brand_{{ $brand->name }}">
                                <label class="form-check-label" for="brand_{{ $brand->name }}">
                                    {{ $brand->name }}
                                </label>
                            </div>
                        @endforeach

                        <!-- Price filter -->
                        <div class="mt-4">
                            <h5 class="text-secondary">Price</h5>
                            <hr>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price_order" value="asc" id="price_asc" {{ isset($priceOrder) && $priceOrder == 'asc' ? 'checked' : '' }}>
                                <label class="form-check-label" for="price_asc">
                                    Low to high
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price_order" value="desc" id="price_desc" {{ isset($priceOrder) && $priceOrder == 'desc' ? 'checked' : '' }}>
                                <label class="form-check-label" for="price_desc">
                                    High to low
                                </label>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
                    </form>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-4 mb-5">
                                <a href="{{'/categories/' . $product->slug }}">
                                    <img src="{{ asset($product->productImages[0]->image) }}" width="100%" height="250px"
                                        alt="">
                                </a>
                                <div>
                                    <h5 class="mt-3 text-dark">@currency($product->price)</h5>
                                    <a href="{{'/categories/' . $product->slug }}">
                                        <p class="m-0 fw-bold">{{ $product->name }}</p>
                                    </a>
                                    <p class="m-0">{{ $product->small_description }}</p>
                                </div>
                            </div>
                        @empty
                            <div>
                                <h2 class="text-secondary text-center">No products found.</h2>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection