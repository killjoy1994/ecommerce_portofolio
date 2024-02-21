@extends('layouts.admin');

@section('content')
    <div class="row mx-1">
        <div class="bg-light rounded h-100 p-4">
            @if (session('message'))
                <div class="alert alert-success mb-3">
                    <h5>{{ session('message') }}</h5>
                </div>
            @endif
            <h6 class="mb-4">Category List
                <a href="/admin/categories/create" class="btn btn-primary float-end">Add category</a>
            </h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <div style="width: 100px; height: 60px">
                                    <img style="width: 100%; height: 100%"
                                        src="{{ asset('storage/category/' . $category->image) }}" alt="">
                                </div>

                            </td>
                            <td>
                                <a class="btn btn-success btn-sm"
                                    href="{{ '/admin/categories/' . $category->id . '/edit' }}">Edit</a>
                                <a class="btn btn-danger btn-sm"
                                    href="{{ '/admin/categories/' . $category->id . '/delete' }}">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="text-center">
                                    <h5>No categories found. <a href="/admin/categories/create">Add</a> category</h5>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
