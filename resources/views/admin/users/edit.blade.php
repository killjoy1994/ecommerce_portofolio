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
                <h4 class="mb-4 text-secondary">Edit User</h4>
                <form action="{{ url('admin/users/'. $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="name" value="{{ $user->name }}"
                            placeholder="name@example.com">
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="email" value="{{ $user->email }}" readonly
                            placeholder="name@example.com">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInput" name="password" 
                            placeholder="name@example.com">
                        <label for="floatingInput">Password</label>
                    </div>
                    <div class="mb-3">
                        <select name="role_as" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                            <option selected>Select Role</option>
                            <option value="0" {{ $user->role_as == "0" ? 'selected' : '' }}>User</option>
                            <option value="1" {{ $user->role_as == "1" ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
