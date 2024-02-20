@extends('layouts.app');

@section('content')
    <div class="h-100 mt-2">
        <div class="container">
            <h3 class="fs-3 fw-4 text-secondary">Checkout</h3>
            <hr>
            <div class="mt-5">
                <div class="bg-light p-4">
                    <h4>Item Total Amount: <span class="float-end">@currency($totalAmount)</span></h4>
                    <hr>
                    <div>
                        <p>* Items will be delivered in 3 - 5 days.</p>
                        <p>* Tax and other charges are included.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="bg-light p-4">
                    <h4>Basic Information</h4>
                    <hr>
                    <form action="/place-order" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Fullname</label>
                                <input type="text" class="form-control" name="fullname" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="phone"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Pin Code (Zip-code)</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="pincode"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="form-label">Full Address</label>
                                <textarea class="form-control" name="address" id="" rows="5" ></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Place Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
