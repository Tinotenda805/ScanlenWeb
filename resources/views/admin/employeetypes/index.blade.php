@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 h3">Employee Types</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEmployeeTypeModal">
            <i class="fas fa-plus-circle me-2"></i>New Type
        </button>
    </div>


    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="employeeTypesTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employeeTypes as $type)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->description }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-sm btn-outline-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $type->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('admin.employee-types.destroy', $type) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this employee type?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @include('admin.employeetypes.partials.edit-modal', ['type' => $type])

                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No employee types found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @include('admin.employeetypes.partials.create-modal')
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4">
        {{ $employeeTypes->links('pagination::bootstrap-5') }}
    </div>
</div>

    


@endsection
