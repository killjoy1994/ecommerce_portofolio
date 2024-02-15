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
                <h4 class="mb-4">Add Slider</h4>
                <form action="{{ url('admin/sliders') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="title"
                            placeholder="name@example.com">
                        <label for="floatingInput">Slider Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"
                            name="description"></textarea>
                        <label for="floatingTextarea">Description</label>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Slider Image</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Slider</button>
                </form>
            </div>
        </div>
    </div>
@endsection
