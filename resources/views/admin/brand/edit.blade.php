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
                <h4 class="mb-4 text-secondary">Edit Brand</h4>
                <form action="{{ url('admin/brands') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="name"
                            placeholder="name@example.com">
                        <label for="floatingInput">Brand Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="slug"
                            placeholder="name@example.com">
                        <label for="floatingInput">Brand Slug</label>
                    </div>
                    <div class="mb-3">
                        <select name="category_id" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                            <option selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Brand</button>
                </form>
            </div>
        </div>
    </div>
@endsection
