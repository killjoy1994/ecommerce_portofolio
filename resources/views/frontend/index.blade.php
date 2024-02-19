@extends('layouts.app')

@section('content')
    <div>
        <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                @foreach ($sliders as $slider)
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="{{ asset($slider->image) }}" class="d-block w-100" style="height: 550px" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="fs-1">{{ $slider->title }}</h3>
                            <p class="fs-4">{{ $slider->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container py-5 bg-white">
            <div class="row">
                <div class="col-6 col-md-3">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam voluptatum libero minima quod eos
                        consequuntur doloribus eaque, cupiditate ipsum consequatur!x</p>
                </div>
                <div class="col-6 col-md-3">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam voluptatum libero minima quod eos
                        consequuntur doloribus eaque, cupiditate ipsum consequatur!x</p>
                </div>
                <div class="col-6 col-md-3">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam voluptatum libero minima quod eos
                        consequuntur doloribus eaque, cupiditate ipsum consequatur!x</p>
                </div>
                <div class="col-6 col-md-3">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam voluptatum libero minima quod eos
                        consequuntur doloribus eaque, cupiditate ipsum consequatur!x</p>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="owl-carousel owl-theme">
                        @foreach ($trendings as $trending)
                            <div class="item">
                                <div class="position-relative">
                                    <img src="{{ asset($trending->productImages[0]->image) }}" height="200px"
                                        alt="">
                                    <a class="badge badge-dark" href="" style="position: absolute; top: 5px; right: 5px">
                                        <i class="fas fa-shopping-cart fs-5"></i>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <h5>{{ $trending->name }}</h5>
                                    <p>Rp. 18.000.000</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h4>Featured Products</h4>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="owl-carousel owl-theme">
                        @foreach ($featured as $featuredItem)
                        <div class="item">
                            <div class="position-relative">
                                <img src="{{ asset($featuredItem->productImages[0]->image) }}" height="200px"
                                    alt="">
                                <a class="badge badge-dark" href="" style="position: absolute; top: 5px; right: 5px">
                                    <i class="fas fa-shopping-cart fs-5"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <h5>{{ $featuredItem->name }}</h5>
                                <p>Rp. 18.000.000</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
@endpush
