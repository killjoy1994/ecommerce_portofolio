@extends('layouts.app')

@section('content')
    <div>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders as $id => $slider)
                    <div class="carousel-item {{ $id == 0 ? 'active' : '' }}" data-bs-interval="10000">
                        <img src="{{ asset($slider->image) }}" class="d-block w-100" style="height: 550px" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="fs-1 text-light">{{ $slider->title }}</h3>
                            <p class="fs-4">{{ $slider->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="py-5 bg-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h4>Welcome, Lorem ipsum dolor sit amet consectetur.</h4>
                        <div class="underline"></div>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod voluptatum, laboriosam quam
                            quaerat
                            voluptatem voluptas. Est praesentium quod distinctio delectus! Eveniet ex atque quae, totam
                            mollitia, earum culpa quisquam officia, officiis possimus eum natus hic aspernatur omnis
                            adipisci
                            eius minima?</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products <a href="/trending" class="float-end text-secondary fs-5">View more</a></h4>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="owl-carousel owl-theme">
                        @foreach ($trendings as $trending)
                            <div class="item">
                                <div class="position-relative">
                                    <a href="{{ '/categories/' . $trending->category->slug . '/' . $trending->slug }}">
                                        <img src="{{ asset($trending->productImages[0]->image) }}" height="200px"
                                            alt="">
                                    </a>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <h5 class="mt-3 text-dark">@currency($trending->price)</h5>
                                        <a href="{{ '/categories/' . $trending->category->slug . '/' . $trending->slug }}">
                                            <p class="m-0 fw-bold">{{ $trending->name }}</p>
                                        </a>
                                        <p class="m-0">{{ $trending->small_description }}</p>
                                    </div>
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
                    <h4>Featured Products <a href="/featured" class="float-end text-secondary fs-5">View more</a></h4>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="owl-carousel owl-theme">
                        @foreach ($featured as $featuredItem)
                            <div class="item">
                                <div class="position-relative">
                                    <img src="{{ asset($featuredItem->productImages[0]->image) }}" height="200px"
                                        alt="">
                                    {{-- <a class="badge badge-dark" href=""
                                        style="position: absolute; top: 5px; right: 5px">
                                        <i class="fas fa-shopping-cart fs-5"></i>
                                    </a> --}}
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <h5 class="mt-3 text-dark">@currency($featuredItem->price)</h5>
                                        <a href="{{ Request::url() . '/' . $featuredItem->slug }}">
                                            <p class="m-0 fw-bold">{{ $featuredItem->name }}</p>
                                        </a>
                                        <p class="m-0">{{ $featuredItem->small_description }}</p>
                                    </div>
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
