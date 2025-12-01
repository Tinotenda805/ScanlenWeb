@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Our People</h1>
        <div class="right">
            <a href="{{ route('admin.employee-types.index') }}" class="btn btn-info">
                <i class="fas fa-user-md me-2"></i>Employee Types
            </a>
            <a href="{{ route('admin.people.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Add Person
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Articles</th>
                            <th>Social</th>
                            <th>Status</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($people as $person)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($person->avatar)
                                    <img src="{{ asset('storage/' . $person->avatar) }}" 
                                         class="rounded-circle me-2" 
                                         width="40" height="40" 
                                         style="object-fit: cover;">
                                    @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" 
                                         style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($person->name, 0, 2)) }}
                                    </div>
                                    @endif
                                    <div>
                                        <strong>{{ $person->name }}</strong>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{$person->employeeType->name ?? ''}}
                            </td>
                            <td><small>{{ $person->email }}</small></td>
                            <td>
                                <span class="badge bg-secondary">{{ $person->articles_count }} articles</span>
                            </td>
                            <td>
                                @if($person->twitter)
                                <a href="{{ $person->twitter }}" target="_blank" class="text-info me-1">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif
                                @if($person->linkedin)
                                <a href="{{ $person->linkedin }}" target="_blank" class="text-primary">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                @endif
                            </td>
                            <td class="text-capitalize">{{$person->status ?? ''}}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.people.edit', $person) }}" 
                                       class="btn btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $person->id }}"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $person->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Person</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.people.destroy', $person) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Are you sure you want to delete "<strong>{{ $person->name }}</strong>"?
                                                    @if($person->articles_count > 0)
                                                    <div class="alert alert-warning mt-2">
                                                        This person has {{ $person->articles_count }} associated article(s).
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="text-muted mb-0">No people found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4">
        {{ $people->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection