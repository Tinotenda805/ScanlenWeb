@extends('admin.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Edit Award: {{ $award->title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.awards.update', $award) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Award Title *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $award->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="issuing_organization" class="form-label">Issuing Organization *</label>
                                    <input type="text" class="form-control @error('issuing_organization') is-invalid @enderror" 
                                           id="issuing_organization" name="issuing_organization" 
                                           value="{{ old('issuing_organization', $award->issuing_organization) }}" required>
                                    @error('issuing_organization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">Year *</label>
                                            <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                                   id="year" name="year" value="{{ old('year', $award->year) }}" 
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
                                                    <option value="{{ $key }}" 
                                                        {{ old('category', $award->category) == $key ? 'selected' : '' }}>
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
                                              id="description" name="description" rows="4">{{ old('description', $award->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="display_order" class="form-label">Display Order</label>
                                            <input type="number" class="form-control @error('display_order') is-invalid @enderror" 
                                                   id="display_order" name="display_order" value="{{ old('display_order', $award->display_order) }}">
                                            <small class="text-muted">Lower numbers display first</small>
                                            @error('display_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="is_active" name="is_active" value="1"
                                                       {{ old('is_active', $award->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    Active
                                                </label>
                                            </div>
                                            <small class="text-muted">Inactive awards won't show on the website</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Featured Image</h5>
                                        @if($award->image_url)
                                        <img src="{{ asset('storage/' . $award->image) }}" 
                                            class="img-fluid rounded mb-3" 
                                            alt="Current featured image">
                                        @endif
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                        <small class="text-muted">Leave empty to keep current image</small>
                                        @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="image" class="form-label">Award Image/Logo</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Recommended: 300x300px, PNG or JPG</small>
                                    
                                    @if($award->image_url)
                                        <div class="mt-3">
                                            <p class="small mb-2">Current Image:</p>
                                            <img src="{{ $award->image_url }}" alt="{{ $award->title }}" 
                                                 class="img-thumbnail" style="max-height: 200px;">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="remove_image" name="remove_image" value="1">
                                                <label class="form-check-label text-danger" for="remove_image">
                                                    Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-3 text-center">
                                            <div class="bg-light rounded p-4">
                                                <i class="fas fa-trophy fa-2x text-muted mb-2"></i>
                                                <p class="small text-muted mb-0">No image uploaded</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div id="imagePreview" class="mt-2 text-center" style="display: none;">
                                        <p class="small mb-2">New Image Preview:</p>
                                        <img id="preview" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.awards.index') }}" class="btn btn-danger">Cancel</a>
                            <div>
                                <button type="submit" class="btn btn-success">Update Award</button>
                                <a href="{{ route('admin.awards.show', $award) }}" class="btn btn-outline-primary">
                                    View Details
                                </a>
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
    // Image preview for new image
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

    // Handle remove image checkbox
    document.getElementById('remove_image')?.addEventListener('change', function(e) {
        if (this.checked) {
            // Hide the current image preview when remove is checked
            const currentImage = this.closest('.mt-3');
            if (currentImage) {
                currentImage.style.opacity = '0.5';
            }
        } else {
            const currentImage = this.closest('.mt-3');
            if (currentImage) {
                currentImage.style.opacity = '1';
            }
        }
    });
</script>
@endpush