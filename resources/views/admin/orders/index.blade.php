@extends('layouts.admin');

@section('content')
    <div class="row mx-1">
        <div class="bg-light rounded h-100 p-4">
            @if (session('message'))
                <div class="alert alert-success mb-3">
                    <h5>{{ session('message') }}</h5>
                </div>
            @endif
            <h5 class="mb-4">Order List
            </h5>
            <div class="">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Filter by date</label>
                            <input type="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" name="date"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Filter by status</label>
                            <select class="form-select" name="status" id="">
                                <option value="">Select status</option>
                                <option value="in progress" {{ Request::get('status') == "in progress" ? 'selected' : '' }}>In progess</option>
                                <option value="completed" {{ Request::get('status') == "completed" ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ Request::get('status') == "pending" ? 'selected' : '' }}>Pending</option>
                                <option value="cancelled" {{ Request::get('status') == "cancelled" ? 'selected' : '' }}>Cancelled</option>
                                <option value="out-for-delivery" {{ Request::get('status') == "out-for-delivery" ? 'selected' : '' }}>Out for delivery</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <hr>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Tracking No</th>
                                <th>Username</th>
                                <th>Ordered Date</th>
                                <th>Status Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->tracking_no }}</td>
                                    <td>{{ $order->fullname }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $order->status_message }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ url('admin/orders/' . $order->id) }}">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No orders available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div>
                        {{ $orders->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
