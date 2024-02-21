@extends('layouts.app');

@section('content')
    <div class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-light p-4">
                        <h4>My Order Detail <span><a class="btn btn-danger btn-sm float-end"
                                    href="/orders">Back</a></span></h4>
                        <hr>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Order Detail</h5>
                                <hr>
                                <div>
                                    <p class="fs-5 mb-0">Order id: {{ $order->id }}</p>
                                    <p class="fs-5 mb-0">Tracking no/id: {{ $order->tracking_no }}</p>
                                    <p class="fs-5 mb-0">Order created date: {{ $order->created_at }}</p>
                                    <p class="fs-5 mb-0">Order status: <span
                                            class="fw-bold {{ $order->status_message == 'in progress' ? 'text-success' : 'text-warning' }}">{{ $order->status_message }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>User Detail</h5>
                                <hr>
                                <div>
                                    <p class="fs-5 mb-0">Username: {{ $order->fullname }}</p>
                                    <p class="fs-5 mb-0">Email: {{ $order->email }}</p>
                                    <p class="fs-5 mb-0">Phone: {{ $order->phone }}</p>
                                    <p class="fs-5 mb-0">Zip/pin code: {{ $order->pincode }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <h5>Order Items</h5>
                            <hr>
                            <table class="table table-striped">
                                <tr>
                                    <thead>
                                        <th>Item Id</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalAmount = 0
                                        @endphp
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    <img src="{{ asset($item->product->productImages[0]->image) }}"
                                                        width="100" height="100" alt="">
                                                </td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>@currency($item->product->price)</td>
                                                <td>{{ $item->quantity }}</td>
                                            </tr>
                                            @php
                                                $totalAmount += $item->product->price * $item->quantity;
                                            @endphp
                                        @endforeach
                                        <tr >
                                            <td colspan="5" class="mt-3">
                                                <h5>Total Amount: <span class="float-end">@currency($totalAmount)</span></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
