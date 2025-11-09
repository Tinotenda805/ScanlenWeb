@extends('admin.app')


@section('content')
@include('admin.header', ['title' => 'View Award'])
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-maroon text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Award Details</h5>
                        <div>
                            <a href="{{ route('admin.awards.edit', $award) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.awards.index') }}" class="btn btn-secondary btn-sm">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            @if($award->image_url)
                                <img src="{{ $award->image_url }}" alt="{{ $award->title }}" 
                                     class="img-fluid rounded shadow mb-3" style="max-height: 300px;">
                            @else
                                <div class="bg-light rounded p-5 mb-3">
                                    <i class="fas fa-trophy fa-4x text-muted"></i>
                                    <p class="text-muted mt-2 mb-0">No image</p>
                                </div>
                            @endif
                            
                            <div class="d-grid gap-2">
                                <span class="badge bg-{{ $award->is_active ? 'success' : 'secondary' }} fs-6">
                                    {{ $award->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                @if($award->category)
                                    <span class="badge bg-primary fs-6">
                                        {{ $award->getCategories()[$award->category] ?? $award->category }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <h2 class="text-maroon">{{ $award->title }}</h2>
                            <p class="lead">{{ $award->issuing_organization }}</p>
                            
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <strong>Year:</strong> {{ $award->year }}
                                </div>
                                <div class="col-sm-6">
                                    <strong>Display Order:</strong> {{ $award->display_order }}
                                </div>
                            </div>
                            
                            @if($award->description)
                                <div class="mb-4">
                                    <h5>Description</h5>
                                    <p class="text-muted">{{ $award->description }}</p>
                                </div>
                            @endif
                            
                            <div class="row text-muted small">
                                <div class="col-sm-6">
                                    <strong>Created:</strong> {{ $award->created_at->format('M j, Y g:i A') }}
                                </div>
                                <div class="col-sm-6">
                                    <strong>Last Updated:</strong> {{ $award->updated_at->format('M j, Y g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection