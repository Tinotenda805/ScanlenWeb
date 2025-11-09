@extends('admin.app')


@section('content')
@include('admin.header', ['title' => 'Manage Awards & Recognitions'])
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-maroon ">
                    <h5 class="mb-0">Add New Award</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.awards.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Award Title *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="issuing_organization" class="form-label">Issuing Organization *</label>
                                    <input type="text" class="form-control @error('issuing_organization') is-invalid @enderror" 
                                           id="issuing_organization" name="issuing_organization" 
                                           value="{{ old('issuing_organization') }}" required>
                                    @error('issuing_organization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">Year *</label>
                                            <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                                   id="year" name="year" value="{{ old('year', date('Y')) }}" 
                                                   min="1900" max="{{ date('Y') + 1 }}" required>
                                            @error('year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-select @error('category') is-invalid @enderror" 
                                                    id="category" name="category">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $key => $value)
                                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-3 p-1">
                                    <label for="display_order" class="form-label">Display Order</label>
                                    <input type="number" class="form-control @error('display_order') is-invalid @enderror" 
                                           id="display_order" name="display_order" value="{{ old('display_order', 0) }}">
                                    <small class="text-muted">Lower numbers display first</small>
                                    @error('display_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card border-0 shadow-sm mb-4 p-1">
                                    <label for="image" class="form-label">Award Image/Logo</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Recommended: 300x300px, PNG or JPG</small>
                                    
                                    <div id="imagePreview" class="mt-2 text-center" style="display: none;">
                                        <img id="preview" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                </div>
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <a href="{{ route('admin.awards.index') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Save Award</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(this.files[0]);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endpush