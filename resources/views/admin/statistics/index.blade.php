@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Statistics Management</h1>
        <a href="{{ route('admin.statistics.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Add Statistic
        </a>
    </div>

    {{-- @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif --}}

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="80">Icon</th>
                        <th>Label</th>
                        <th>Value</th>
                        <th width="80">Order</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statistics as $stat)
                    <tr>
                        <td class="text-center">
                            @if($stat->icon)
                                <i class="{{ $stat->icon }}" style="font-size: 1.5rem; color: #dc3545;"></i>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td><strong>{{ $stat->label }}</strong></td>
                        <td><span class="badge bg-primary fs-6">{{ $stat->value }}</span></td>
                        <td class="text-center">{{ $stat->order }}</td>
                        <td>
                            <span class="badge bg-{{ $stat->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($stat->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.statistics.edit', $stat) }}" 
                                   class="btn btn-outline-primary" 
                                   title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-outline-danger" 
                                        onclick="deleteStat({{ $stat->id }})"
                                        title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>

                            <form id="delete-form-{{ $stat->id }}" 
                                  action="{{ route('admin.statistics.destroy', $stat) }}" 
                                  method="POST" 
                                  class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fa fa-file" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">No statistics found. Create your first one!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($statistics->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $statistics->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function deleteStat(id) {
    if (confirm('Are you sure you want to delete this statistic?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection