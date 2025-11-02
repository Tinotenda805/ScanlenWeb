@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <h1>Create New Blog Post</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Blog Post Details</h5>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
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

                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Excerpt *</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                      id="excerpt" 
                                      name="excerpt" 
                                      rows="3" 
                                      required>{{ old('excerpt') }}</textarea>
                            <small class="text-muted">Brief description of the blog post</small>
                            @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content *</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" 
                                      name="content" 
                                      rows="15" 
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Publish Settings -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Publish Settings</h5>
                        
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_published" value="0">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_published" 
                                       name="is_published" 
                                       value="1" 
                                       {{ old('is_published', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">Published</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_featured" value="0">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_featured" 
                                       name="is_featured" 
                                       value="1" 
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="datetime-local" 
                                   class="form-control @error('published_at') is-invalid @enderror" 
                                   id="published_at" 
                                   name="published_at" 
                                   value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                            @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Author -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Author</h5>
                        <input type="text" 
                               class="form-control @error('author_name') is-invalid @enderror" 
                               name="author_name" 
                               placeholder="Author Name" 
                               value="{{ old('author_name') }}">
                        <small class="text-muted">Optional: Leave empty if anonymous</small>
                        @error('author_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Category -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Category *</h5>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                name="category_id" 
                                required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tags -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Tags</h5>
                        <div style="max-height: 200px; overflow-y: auto;">
                            @foreach($tags as $tag)
                            <div class="form-check mb-2">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="tags[]" 
                                       value="{{ $tag->id }}" 
                                       id="tag{{ $tag->id }}"
                                       {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tag{{ $tag->id }}">
                                    {{ $tag->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Featured Image</h5>
                        <input type="file" 
                               class="form-control @error('featured_image') is-invalid @enderror" 
                               name="featured_image" 
                               accept="image/*">
                        @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Reading Time -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Reading Time *</h5>
                        <div class="input-group">
                            <input type="number" 
                                   class="form-control @error('reading_time') is-invalid @enderror" 
                                   name="reading_time" 
                                   value="{{ old('reading_time', 3) }}" 
                                   min="1" 
                                   required>
                            <span class="input-group-text">minutes</span>
                        </div>
                        @error('reading_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <button type="submit" class="btn btn-success w-100 mb-2">
                            <i class="fas fa-save me-2"></i>Create Blog Post
                        </button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary w-100">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection