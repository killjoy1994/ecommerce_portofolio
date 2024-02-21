@extends('layouts.admin');

@section('content')
    <div class="row mx-1 mb-5">
        <div class="bg-light rounded h-100 p-4">
            @if (session('message'))
                <div class="alert alert-success mb-3">
                    <h5>{{ session('message') }}</h5>
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <h4 class="mb-4">Order Details</h4>
                <div>
                    <a href="/admin/categories/create" class="btn btn-danger ms-2 d-block btn-sm float-end">Back</a>
                    <a href={{ "/admin/invoice/" . $order->id }} class="btn btn-warning text-light ms-2 d-block btn-sm float-end">View PDF</a>
                    <a href={{ "/admin/invoice/" . $order->id . '/generate'}} class="btn btn-primary ms-2 d-block btn-sm float-end">Generate PDF</a>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h6>Order Detail</h6>
                    <hr>
                    <div>
                        <p class="fs-5 mb-0">Order id: {{ $order->id }}</p>
                        <p class="fs-5 mb-0">Tracking no/id: {{ $order->tracking_no }}</p>
                        <p class="fs-5 mb-0">Order created date: {{ $order->created_at }}</p>
                        <p class="fs-5 mb-0">Order status: <span
                                class="fw-bold {{ $order->status_message == 'in progress' || $order->status_message == 'completed' ? 'text-success' : 'text-warning' }}">{{ $order->status_message }}</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>User Detail</h6>
                    <hr>
                    <div>
                        <p class="fs-5 mb-0">Username: {{ $order->fullname }}</p>
                        <p class="fs-5 mb-0">Email: {{ $order->email }}</p>
                        <p class="fs-5 mb-0">Phone: {{ $order->phone }}</p>
                        <p class="fs-5 mb-0">Zip/pin code: {{ $order->pincode }}</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mt-4">
                <h6>Order Items</h6>
                <hr>
                <table class="table table-bordered table-striped">
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
                                $totalAmount = 0;
                            @endphp
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset($item->product->productImages[0]->image) }}" width="100"
                                            height="100" alt="">
                                    </td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>@currency($item->product->price)</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                                @php
                                    $totalAmount += $item->product->price * $item->quantity;
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="5" class="mt-3">
                                    <h5>Total Amount: <span class="float-end">@currency($totalAmount)</span></h5>
                                </td>
                            </tr>
                        </tbody>
                    </tr>
                </table>
            </div>
            <br>
            <div class="mt-4">
                <h4>Order Process (Order Status Updates)</h4>
                <hr>

                <div class="row">
                    <div class="col-md-5">
                        <form action="{{ url('admin/orders/' . $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label for="">Update your order status</label>
                            <div class="input-group">
                                <select class="form-select" name="status_message" id="">
                                    <option value="">Select status</option>
                                    <option value="in progress"
                                        {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In progess
                                    </option>
                                    <option value="completed"
                                        {{ Request::get('status') == 'completed' ? 'selected' : '' }}>Completed
                                    </option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="cancelled"
                                        {{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                    </option>
                                    <option value="out-for-delivery"
                                        {{ Request::get('status') == 'out-for-delivery' ? 'selected' : '' }}>Out for
                                        delivery</option>
                                </select>
                                <button class="btn btn-primary text-white" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <p class="m-0 fs-5 fw-bold mt-3">Current Order Status: <span
                                class="text-uppercase text-success">{{ $order->status_message }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
