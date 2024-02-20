@extends('layouts.app');

@section('content')
    <div class="h-100 mt-5">
        <div class="container">
            <div class="row gx-4 product_data">
                <div class="col-md-5">
                    @if ($product->productImages)
                    {{-- <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"> --}}
                    <div class="exzoom" id="exzoom">
                        <!-- Images -->
                        <div class="exzoom_img_box">
                            <ul class='exzoom_img_ul'>
                                @foreach ($product->productImages as $itemImage)
                                    <li><img src="{{ asset($itemImage->image) }}" /></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                        <div class="exzoom_nav"></div>
                        <!-- Nav Buttons -->
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn">
                                < </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                        </p>
                    </div>
                @else
                    No Images
                @endif
                </div>
                <div class="col-md-7 bg-light p-3">
                    <div>
                        <h3>{{ $product->name }}</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ '/categories' }}">Categories</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ '/categories/' . $category->slug }}">{{ $category->name }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </nav>
                        <p class="fs-4 fw-700">@currency($product->price)</p>
                        @if ($product->quantity > 0)
                            <label for="" class="badge btn-success p-2">In Stock</label>
                        @else
                            <label for="" class="badge btn-danger p-2">Out Of Stock</label>
                        @endif
                        <div class="my-3 d-flex align-items-center">
                            <div class="d-flex">
                                <input type="hidden" value="{{ $product->id }}" class="product_id">
                                <span class="decrement-btn btn  btn-outline-secondary">-</span>
                                <input class="text-center qty-input" style="width: 70px" type="text" value="1">
                                <span class="increment-btn btn btn-outline-secondary">+</span>
                            </div>
                            <div class="ms-4">
                                <p class="p-0 m-0">Total Stock : <span class="fw-bold">{{ $product->quantity }}</span></p>
                            </div>
                        </div>
                        <div class="my-3">
                            <button class="p-2 btn_product"><i class="fas fa-heart"></i> Add to wishlist</button>
                            <button class="p-2 btn_product addToCartBtn"><i class="fas fa-shopping-cart"></i> Add
                                to cart</button>
                        </div>
                        <div class="my-2">
                            <h4>Small Description</h4>
                            <p>{{ $product->small_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="my-2 bg-light mt-4 p-3">
                        <h4>Description</h4>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-md-12">
                    <div>
                        <h3>Related Products</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {

            $("#exzoom").exzoom({

                // thumbnail nav options
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,

                // autoplay
                "autoPlay": false,

                // autoplay interval in milliseconds
                "autoPlayTimeout": 2000

            });

        });
    </script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            var totalStock = '{{ $product->quantity }}';

            $('.addToCartBtn').click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.product_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty-input').val();

                // console.log("ID: ", product_id, 'QTY: ', product_qty);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/cart",
                    data: {
                        "product_id": product_id,
                        "product_quantity": product_qty
                    },
                    success: function(response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: response.type,
                            title: response.status
                        });
                    }
                });
            });

            $('.increment-btn').click(function(e) {
                e.preventDefault();

                // var inc_value = $('.qty-input').val();
                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;

                if (value < totalStock) {
                    value++;
                    //$('.qty-input').val(value);
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });

            $('.decrement-btn').click(function(e) {
                e.preventDefault();

                // var dec_value = $('.qty-input').val();
                var dec_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;

                if (value > 1) {
                    value--;
                    // $('.qty-input').val(value);
                    $(this).closest('.product_data').find('.qty-input').val(value);

                }
            });
        });
    </script>
@endpush
