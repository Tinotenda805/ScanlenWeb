@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Create Timeline Entry</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.history.index') }}">History Timeline</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('admin.history.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Timeline Information</h5>
                    </div>
                    <div class="card-body">
                        {{-- Decade --}}
                        <div class="mb-3">
                            <label for="decade" class="form-label">Decade <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('decade') is-invalid @enderror" 
                                   id="decade" 
                                   name="decade" 
                                   value="{{ old('decade') }}"
                                   placeholder="e.g., 1980s, 1990s, 2000s"
                                   required>
                            @error('decade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            {{-- <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="5"
                                      required>{{ old('description') }}</textarea> --}}
                            <input type="hidden" name="description" id="description">
                            <div id="editor" data-quill data-target="description" style="height:200px"></div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Highlights --}}
                        <div class="mb-3">
                            <label class="form-label">Highlights</label>
                            <div id="highlights-container">
                                @if(old('highlights'))
                                    @foreach(old('highlights') as $index => $highlight)
                                    <div class="input-group mb-2 highlight-item">
                                        <input type="text" 
                                               class="form-control" 
                                               name="highlights[]" 
                                               value="{{ $highlight }}"
                                               placeholder="Enter highlight point">
                                        <button type="button" class="btn btn-outline-danger remove-highlight">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 highlight-item">
                                        <input type="text" 
                                               class="form-control" 
                                               name="highlights[]" 
                                               placeholder="Enter highlight point">
                                        <button type="button" class="btn btn-outline-danger remove-highlight">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="add-highlight">
                                <i class="fa fa-plus"></i> Add Highlight
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                {{-- Publish Settings --}}
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
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Order --}}
                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', 0) }}"
                                   min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-save"></i> Create Timeline Entry
                        </button>
                        <a href="{{ route('admin.history.index') }}" class="btn btn-secondary w-100 mt-2">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Image --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Image</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               onchange="previewImage(this)">
                        <small class="text-muted">Optional. Recommended: 800x600px</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="imagePreview" class="mt-3 text-center d-none">
                            <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Add highlight
document.getElementById('add-highlight').addEventListener('click', function() {
    const container = document.getElementById('highlights-container');
    const newItem = document.createElement('div');
    newItem.className = 'input-group mb-2 highlight-item';
    newItem.innerHTML = `
        <input type="text" 
               class="form-control" 
               name="highlights[]" 
               placeholder="Enter highlight point">
        <button type="button" class="btn btn-outline-danger remove-highlight">
            <i class="fa fa-trash"></i>
        </button>
    `;
    container.appendChild(newItem);
});

// Remove highlight
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-highlight') || e.target.closest('.remove-highlight')) {
        const item = e.target.closest('.highlight-item');
        if (document.querySelectorAll('.highlight-item').length > 1) {
            item.remove();
        } else {
            alert('At least one highlight field is required.');
        }
    }
});

// Image preview
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
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
@endsection
