@extends('layouts.admin');

@section('content')
    <div class="row mx-1">
        <div class="bg-light rounded h-100 p-4">
            @if (session('message'))
                <div class="alert alert-success mb-3">
                    <h5>{{ session('message') }}</h5>
                </div>
            @endif
            <h6 class="mb-4">Brand List</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sliders as $slider)
                        <tr>
                            <td>{{ $slider->id }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->description }}</td>
                            <td>
                                <div style="width: 100px; height: 60px">
                                    <img style="width: 100%; height: 100%"
                                        src="{{ asset($slider->image) }}" alt="">
                                </div>

                            </td>
                            <td>
                                <a class="btn btn-success btn-sm"
                                    href="{{ '/admin/sliders/' . $slider->id . '/edit' }}">Edit</a>
                                <a class="btn btn-danger btn-sm"
                                    href="{{ '/admin/sliders/' . $slider->id . '/delete' }}">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="text-center">
                                    <h5>No brands found. <a href="/admin/sliders/create">Add</a> slider</h5>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
