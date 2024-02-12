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
               
                <h4 class="mb-4">Edit Category</h4>
                <form action="{{ url('admin/categories/' . $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="name"
                            value="{{ $category->name }}" placeholder="name@example.com">
                        <label for="floatingInput">Category Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="slug"
                            value="{{ $category->slug }}" placeholder="name@example.com">
                        <label for="floatingInput">Category Slug</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"
                            name="description">{{ $category->description }}</textarea>
                        <label for="floatingTextarea">Description</label>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Category Image</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                        <img class="mt-2" src="{{ asset('storage/category/' . $category->image) }}" width="200"
                            height='120' alt="">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection
