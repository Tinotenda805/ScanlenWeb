@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Gallery Item</h1>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Gallery
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $gallery->title) }}" 
                                   required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3">{{ old('description', $gallery->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            
                            @if($gallery->image)
                            <div class="mb-2">
                                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" 
                                     class="img-thumbnail" style="max-width: 300px;">
                            </div>
                            @endif
                            
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Leave empty to keep current image. Max size: 5MB.</small>
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror" 
                                        id="category" 
                                        name="category" 
                                        required>
                                    <option value="">Select Category</option>
                                    <option value="our-team" {{ old('category', $gallery->category) === 'our-team' ? 'selected' : '' }}>Our Team</option>
                                    <option value="practice-areas" {{ old('category', $gallery->category) === 'practice-areas' ? 'selected' : '' }}>Practice Areas</option>
                                    <option value="achievements" {{ old('category', $gallery->category) === 'achievements' ? 'selected' : '' }}>Achievements</option>
                                    <option value="resources" {{ old('category', $gallery->category) === 'resources' ? 'selected' : '' }}>Resources</option>
                                    <option value="events" {{ old('category', $gallery->category) === 'events' ? 'selected' : '' }}>Events</option>
                                    <option value="awards" {{ old('category', $gallery->category) === 'awards' ? 'selected' : '' }}>Awards</option>
                                </select>
                                @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="badge_label" class="form-label">Badge Label</label>
                                <input type="text" 
                                       class="form-control @error('badge_label') is-invalid @enderror" 
                                       id="badge_label" 
                                       name="badge_label" 
                                       value="{{ old('badge_label', $gallery->badge_label) }}"
                                       placeholder="e.g., New, Featured">
                                @error('badge_label')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="link_url" class="form-label">Link URL</label>
                                <input type="url" 
                                       class="form-control @error('link_url') is-invalid @enderror" 
                                       id="link_url" 
                                       name="link_url" 
                                       value="{{ old('link_url', $gallery->link_url) }}"
                                       placeholder="https://example.com">
                                @error('link_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="order" class="form-label">Order</label>
                                <input type="number" 
                                       class="form-control @error('order') is-invalid @enderror" 
                                       id="order" 
                                       name="order" 
                                       value="{{ old('order', $gallery->order ?? 0) }}"
                                       min="0">
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Lower numbers appear first</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="active" {{ old('status', $gallery->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $gallery->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Gallery Item
                            </button>
                            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Item Details</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Created:</strong> {{ $gallery->created_at->format('M d, Y H:i') }}</p>
                    <p class="mb-2"><strong>Updated:</strong> {{ $gallery->updated_at->format('M d, Y H:i') }}</p>
                    <p class="mb-0"><strong>Current Status:</strong> 
                        @if($gallery->status === 'active')
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-warning">Inactive</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-2">Once you delete this item, there is no going back.</p>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem()">
                        <i class="bi bi-trash"></i> Delete Item
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

function deleteItem() {
    if (confirm('Are you sure you want to delete this gallery item? This action cannot be undone.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection