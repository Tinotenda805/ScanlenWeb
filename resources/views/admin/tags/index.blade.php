@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Tags</h1>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-secondary">
            <i class="fas fa-plus me-2"></i>New Tag
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Articles</th>
                            <th>Blogs</th>
                            <th>Total Usage</th>
                            <th style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">#{{ $tag->name }}</span>
                            </td>
                            <td><code>{{ $tag->slug }}</code></td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
                