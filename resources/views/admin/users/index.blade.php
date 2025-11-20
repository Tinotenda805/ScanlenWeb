@extends('admin.app')

@section('content')
@include('admin.header', ['title' => 'Users'])
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0"></h5>
        <a data-bs-toggle="modal" data-bs-target="#addNewUser" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Add New user
        </a>

        <div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-1">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" :value="old('name')" required autofocus autocomplete="name" >
                            </div>
                            <div class="mb-1">
                                <label for="message-text" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" name="email" :value="old('email')" required autocomplete="username" >
                            </div>
                            <div class="mb-1">
                                <label for="message-text" class="col-form-label">User Type:</label>
                                <select name="role" id="" class="form-select" :value="old('role')" required>
                                    <option value="user">USER</option>
                                    <option value="admin">ADMIN</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="message-text" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                            <div class="mb-1">
                                <label for="message-text" class="col-form-label">Confirm Password:</label>
                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name ?? ''}}</td>
                            <td>{{$user->email ?? ''}}</td>
                            <td class="text-uppercase">{{$user->role ?? ''}}</td>
                            <td>
                                <div class="btn-group btn-group-sm ">
                                    <button type="submit"
                                            class="btn btn-outline-primary" title="Edit"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#updateUser{{$user->id}}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="submit" class="btn btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $user->id }}"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>


                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete user Post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{route('admin.users.delete', $user->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Are you sure you want to delete <strong>{{ $user->name ?? '' }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- update user --}}
                                    <div class="modal fade" id="updateUser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                                                    @csrf
                                                    {{-- @method('PUT') --}}
                                                    <div class="modal-body">
                                                        <div class="mb-1">
                                                            <label for="recipient-name" class="col-form-label">Name:</label>
                                                            <input type="text" class="form-control" name="name" value="{{$user->name ?? ''}}" required autofocus autocomplete="name" >
                                                        </div>
                                                        <div class="mb-1">
                                                            <label for="message-text" class="col-form-label">Email:</label>
                                                            <input type="email" class="form-control" name="email" value="{{$user->email ?? ''}}" required autocomplete="username" >
                                                        </div>
                                                        <div class="mb-1">
                                                            <label for="message-text" class="col-form-label">User Type:</label>
                                                            <select name="role" id="" class="form-select" :value="old('role')" required>
                                                                <option value="user" {{$user->role == 'user' ? 'selected':''}}>USER</option>
                                                                <option value="admin" {{$user->role == 'admin' ? 'selected':''}}>ADMIN</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-trophy fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No users found.</p>
                                <a href="{{ route('users.create') }}" class="btn btn-maroon">
                                    Add Your First user
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection