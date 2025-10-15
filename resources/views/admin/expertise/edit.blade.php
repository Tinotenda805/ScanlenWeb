@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">{{ isset($expertise) ? 'Edit Expertise' : 'Create New Expertise' }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.expertise.index') }}">Expertise</a></li>
                    <li class="breadcrumb-item active">{{ isset($expertise) ? 'Edit' : 'Create' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ isset($expertise) ? route('admin.expertise.update', $expertise->id) : route('admin.expertise.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          id="expertiseForm">
        @csrf
        @if(isset($expertise))
            @method('PUT')
        @endif

        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Expertise Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $expertise->name ?? '') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" 
                                   class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" 
                                   name="slug" 
                                   value="{{ old('slug', $expertise->slug ?? '') }}"
                                   placeholder="Leave blank to auto-generate">
                            <small class="text-muted">URL-friendly version of the name</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Short Description --}}
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                      id="short_description" 
                                      name="short_description" 
                                      rows="3"
                                      maxlength="500">{{ old('short_description', $expertise->short_description ?? '') }}</textarea>
                            <small class="text-muted">Brief description for listing pages (max 500 characters)</small>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Overview --}}
                        <div class="mb-3">
                            <label for="overview" class="form-label">Overview / Detailed Description</label>
                            <textarea class="form-control @error('overview') is-invalid @enderror" 
                                      id="overview" 
                                      name="overview" 
                                      rows="10">{{ old('overview', $expertise->overview ?? '') }}</textarea>
                            <small class="text-muted">Detailed information about this expertise</small>
                            @error('overview')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Related Expertise --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Related Practice Areas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($allExpertise as $item)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="related_expertise[]" 
                                           value="{{ $item->id }}"
                                           id="related_{{ $item->id }}"
                                           {{ isset($expertise) && $expertise->relatedExpertise->contains($item->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="related_{{ $item->id }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Key Contacts --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Key Contacts</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Select team members who specialize in this practice area</p>
                        <div class="row g-3">
                            @foreach($people as $person)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="key_contacts[]" 
                                           value="{{ $person->id }}"
                                           id="contact_{{ $person->id }}"
                                           {{ isset($expertise) && $expertise->people->contains($person->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="contact_{{ $person->id }}">
                                        <strong>{{ $person->name }}</strong>
                                        @if($person->designation)
                                            <br><small class="text-muted">{{ $person->designation }}</small>
                                        @endif
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Publish --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="active" {{ old('status', $expertise->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $expertise->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Featured --}}
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_featured" 
                                       name="is_featured" 
                                       value="1"
                                       {{ old('is_featured', $expertise->is_featured ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Featured Expertise
                                </label>
                            </div>
                            <small class="text-muted">Display in featured section</small>
                        </div>

                        {{-- Order --}}
                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', $expertise->order ?? 0) }}"
                                   min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save"></i> {{ isset($expertise) ? 'Update' : 'Create' }} Expertise
                        </button>
                        <a href="{{ route('admin.expertise.index') }}" class="btn btn-secondary w-100 mt-2">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Main Image --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Main Image</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($expertise) && $expertise->image)
                        <div class="mb-3 text-center">
                            <img src="{{ $expertise->image_url }}" 
                                 alt="Current Image" 
                                 class="img-fluid rounded"
                                 style="max-height: 200px;">
                        </div>
                        @endif

                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               onchange="previewImage(this, 'imagePreview')">
                        <small class="text-muted">Recommended: 800x600px, Max 2MB</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="imagePreview" class="mt-3 text-center d-none">
                            <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                </div>

                {{-- Banner Image --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Banner Image</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($expertise) && $expertise->banner_image)
                        <div class="mb-3 text-center">
                            <img src="{{ $expertise->banner_url }}" 
                                 alt="Current Banner" 
                                 class="img-fluid rounded"
                                 style="max-height: 150px;">
                        </div>
                        @endif

                        <input type="file" 
                               class="form-control @error('banner_image') is-invalid @enderror" 
                               id="banner_image" 
                               name="banner_image" 
                               accept="image/*"
                               onchange="previewImage(this, 'bannerPreview')">
                        <small class="text-muted">For detail page header. Recommended: 1920x600px</small>
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="bannerPreview" class="mt-3 text-center d-none">
                            <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Auto-generate slug from name
document.getElementById('name')?.addEventListener('blur', function() {
    const slugInput = document.getElementById('slug');
    if (!slugInput.value) {
        slugInput.value = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
});

// Image preview function
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const img = preview.querySelector('img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<style>
.form-check-label {
    cursor: pointer;
}

.card-header h5 {
    font-size: 1.1rem;
    font-weight: 600;
}
</style>
@endsection