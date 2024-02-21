@extends('layouts.app');

@section('content')
    <div class="h-100">
        <div class="container">
            <h3 class="fs-2 text-secondary fw-4">My Orders</h3>
            <hr>
            <div class="mt-4 row">
               <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tracking No</th>
                        <th>Username</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->tracking_no }}</td>
                            <td>{{ $order->fullname }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->status_message }}</td>
                            <td>
                                <a href="{{ '/orders/' . $order->id }}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               </table>
            </div>
        </div>
    </div>
@endsection