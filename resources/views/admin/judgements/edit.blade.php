@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Edit Judgement</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.judgements.index') }}">Judgements</a></li>
                    <li class="breadcrumb-item active">Edit: {{ $judgement->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('admin.judgements.update', $judgement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Judgement Information</h5>
                    </div>
                    <div class="card-body">
                        {{-- All form fields same as create --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $judgement->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="case_number" class="form-label">Case Number</label>
                            <input type="text" 
                                   class="form-control @error('case_number') is-invalid @enderror" 
                                   id="case_number" 
                                   name="case_number" 
                                   value="{{ old('case_number', $judgement->case_number) }}">
                            @error('case_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4">{{ old('description', $judgement->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="judgement_date" class="form-label">Judgement Date</label>
                                <input type="date" 
                                       class="form-control @error('judgement_date') is-invalid @enderror" 
                                       id="judgement_date" 
                                       name="judgement_date" 
                                       value="{{ old('judgement_date', $judgement->judgement_date ? $judgement->judgement_date->format('Y-m-d') : '') }}">
                                @error('judgement_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="court" class="form-label">Court</label>
                                <input type="text" 
                                       class="form-control @error('court') is-invalid @enderror" 
                                       id="court" 
                                       name="court" 
                                       value="{{ old('court', $judgement->court) }}">
                                @error('court')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" 
                                    name="category_id">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', $judgement->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" 
                                   class="form-control @error('tags') is-invalid @enderror" 
                                   id="tags" 
                                   name="tags" 
                                   value="{{ old('tags', $judgement->tags_string) }}">
                            <small class="text-muted">Separate multiple tags with commas</small>
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="active" {{ old('status', $judgement->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $judgement->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_featured" 
                                       name="is_featured" 
                                       value="1"
                                       {{ old('is_featured', $judgement->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Featured Judgement
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', $judgement->order) }}"
                                   min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save"></i> Update Judgement
                        </button>
                        <a href="{{ route('admin.judgements.index') }}" class="btn btn-secondary w-100 mt-2">
                            Cancel
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Document File</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Current File:</strong><br>
                            <span class="badge bg-secondary">{{ strtoupper($judgement->file_type) }}</span>
                            {{ $judgement->formatted_file_size }}<br>
                            <a href="{{ $judgement->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                <i class="bi bi-eye"></i> View Current File
                            </a>
                        </div>

                        <hr>

                        <input type="file" 
                               class="form-control @error('file') is-invalid @enderror" 
                               id="file" 
                               name="file" 
                               accept=".pdf,.doc,.docx"
                               onchange="showFileInfo(this)">
                        <small class="text-muted">Leave empty to keep current file. Max: 10MB</small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="fileInfo" class="mt-3 d-none">
                            <div class="alert alert-success mb-0">
                                <strong>New File:</strong><br>
                                <span id="fileName"></span><br>
                                <small>Size: <span id="fileSize"></span></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function showFileInfo(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');

        fileName.textContent = file.name;
        
        const bytes = file.size;
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let unitIndex = 0;
        
        while (size > 1024 && unitIndex < units.length - 1) {
            size /= 1024;
            unitIndex++;
        }
        
        fileSize.textContent = size.toFixed(2) + ' ' + units[unitIndex];
        fileInfo.classList.remove('d-none');
    }
}
</script>
@endsection