@extends('layouts.app');

@section('content')
    <div class="h-100 mt-2">
        <div class="container">
            <h3 class="fs-3 fw-4 text-secondary">My Cart</h3>
            <hr>
            <div class="mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cart as $cartItem)
                            <tr class="product_data">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($cartItem->products->productImages[0]->image) }}" width="100px"
                                            height="100px" alt="">
                                        <p class="fw-bold m-0 ms-3">{{ $cartItem->products->name }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center" style="height: 100">
                                        <p class="fw-bold m-0">
                                            @currency($cartItem->products->price)
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center" style="height: 100">
                                        <div class="d-flex">
                                            <input type="hidden" value="{{ $cartItem->products->id }}" class="product_id">
                                            <span class="decrement-btn btn changeQuantity  btn-outline-secondary">-</span>
                                            <input class="text-center qty-input" style="width: 70px" type="text"
                                                value="{{ $cartItem->quantity }}">
                                            <span class="increment-btn changeQuantity btn btn-outline-secondary">+</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center" style="height: 100">
                                        <p class="m-0 fw-bold">RP. 10.000.000</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center" style="height: 100">
                                        <button class="btn btn-danger btn-sm delete-cart-item">Remove</button>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $total += $cartItem->products->price * $cartItem->quantity;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

                <div class="row d-flex justify-content-between align-items-center mt-4">
                    <div class="col-md-5">
                        <p class="fs-5 fw-bold">Get best deals and offers, <a href="">shop now</a></p>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light p-3">
                            <div>
                                <h4>Total: <span class="float-end">@currency($total)</span></h4>
                            </div>
                            <a href="" class="btn btn-warning w-100 fs-5 fw-bold">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

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
                        F
                    }
                });
            });

            $('.increment-btn').click(function(e) {
                e.preventDefault();

                // var inc_value = $('.qty-input').val();
                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                console.log("INC: ", inc_value);
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;

                if (value < 10) {
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

            $('.delete-cart-item').click(function(e) {
                e.preventDefault();

                var prod_id = $(this).closest('.product_data').find('.product_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/delete-cart-item",
                    data: {
                        product_id: prod_id
                    },
                    success: function(response) {
                        window.location.reload();
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

            $('.changeQuantity').click(function(e) {
                e.preventDefault();

                var prod_id = $(this).closest('.product_data').find('.product_id').val();
                var qty = $(this).closest('.product_data').find('.qty-input').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/update-cart",
                    data: {
                        product_id: prod_id,
                        quantity: qty
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endpush
