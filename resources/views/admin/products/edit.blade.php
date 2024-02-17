@extends('layouts.admin')

@section('content')
    <div class="row mx-1">
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="mb-4 text-secondary">Edit Product</h4>
                <form action="{{ url('admin/products/'. $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                                type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $product->name }}"
                                    name="name" placeholder="name@example.com">
                                <label for="floatingInput">Product Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $product->slug }}"
                                    name="slug" placeholder="name@example.com">
                                <label for="floatingInput">Product Slug</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    value="{{ $product->small_description }}" name="small_description"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Small description</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="description" value="{{ $product->description }}" placeholder="Leave a comment here"
                                    id="floatingTextarea" style="height: 150px;">{{ $product->description }}</textarea>
                                <label for="floatingTextarea">Description</label>
                            </div>
                            <div class="mb-3">
                                <select name="category_id" class="form-select form-select-md mb-3"
                                    aria-label=".form-select-md example" id="category">
                                    <option>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-select-md mb-3"
                                    aria-label=".form-select-md example" name="brand" id="brand">
                                    {{-- <option>Select Brand</option> --}}
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}"
                                        {{ $brand->name == $product->brand ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" value="{{ $product->price }}" name="price"
                                            placeholder="name@example.com" min="1">
                                        <label for="floatingInput">Price</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" value="{{ $product->quantity }}" name="quantity"
                                            placeholder="name@example.com" min="1">
                                        <label for="floatingInput">Quantity</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" {{ $product->trending == '1' ? "checked" : "" }} type="checkbox" name="trending"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Trending
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" {{ $product->featured == '1' ? "checked" : "" }} type="checkbox" name="featured"
                                    id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    Featured
                                </label>
                            </div>
                            <div class="row mb-3">
                                <div class="mb-3 col-md-12">
                                    <label for="formFileMultiple" class="form-label">Product Images</label>
                                    <input class="form-control" name="image[]" type="file" id="formFileMultiple"
                                        multiple>
                                </div>
                                <div class="row">
                                    @foreach ($product->productImages as $imageFile)
                                        <div class="col-md-2">
                                            <img src="{{ asset($imageFile->image) }}" style="width: 100px; height:100px"
                                                alt="">
                                            <a href="{{ '/admin/product-image/' . $imageFile->id . '/delete' }}">remove</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#category').change(function() {
            // console.log("Hallo")
            var categoryID = $(this).val();
            if (categoryID) {
                $.ajax({
                    type: "GET",
                    url: "/admin/getbrand?categoryID=" + categoryID,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res.length !== 0) {
                            console.log(res);
                            $("#brand").empty();
                            // $("#category").append('<option>---Pilih Brand---</option>');
                            $.each(res, function(name, id) {
                                $("#brand").append(`<option value=${name}>${name}</option>`);
                            });
                        } else {
                            console.log(res);
                            $("#brand").empty();
                            // console.log("NOL VALUE")
                            $("#brand").append('<option value=""> This category has no brand</option>');
                        }
                    }
                });
            } else {
                $("#brand").empty();
            }
        });
    </script>
@endpush
