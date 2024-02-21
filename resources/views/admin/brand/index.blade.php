@extends('layouts.admin');

@section('content')
    <div class="row mx-1">
        <div class="bg-light rounded h-100 p-4">
            @if (session('message'))
                <div class="alert alert-success mb-3">
                    <h5>{{ session('message') }}</h5>
                </div>
            @endif
            <h6 class="mb-4">Brand List <a href="/admin/brands/create" class="btn btn-primary float-end">Add brand</a></h6>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->slug }}</td>
                            <td>{{ $brand->category->name }}</td>
                            <td>
                                <a class="btn btn-success btn-sm"
                                    href="{{ '/admin/categories/' . $brand->id . '/edit' }}">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ '/admin/categories/' . $brand->id . '/delete'}}">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="text-center">
                                    <h5>No brands found. <a href="/admin/categories/create">Add</a> category</h5>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
