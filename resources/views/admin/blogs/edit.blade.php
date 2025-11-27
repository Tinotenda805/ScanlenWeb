@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <h1>Edit Blog Post</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
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
                                   value="{{ old('title', $blog->title) }}" 
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
                                      required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                            @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content *</label>
                            <input type="hidden" name="content" id="content" value="{{ old('content', $blog->content) ?? ''}}">
                            <div id="editor" data-quill data-target="content" style="height:600px"></div>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- SEO & Readability Panel -->
                @include('admin.blogs.seo-panel')

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
                                       {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
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
                                       {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="datetime-local" 
                                   class="form-control @error('published_at') is-invalid @enderror" 
                                   id="published_at" 
                                   name="published_at" 
                                   value="{{ old('published_at', $blog->published_at->format('Y-m-d\TH:i')) }}">
                            @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Author -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Authors</h5>
                        <div style="max-height: 200px; overflow-y: auto;">
                            @foreach($people as $person)
                            <div class="form-check mb-2">
                                <input class="form-check-input @error('authors') is-invalid @enderror" 
                                    type="checkbox" 
                                    name="authors[]" 
                                    value="{{ $person->id }}" 
                                    id="author{{ $person->id }}"
                                    {{ in_array($person->id, old('authors', $blog->authors->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label" for="author{{ $person->id }}">
                                    {{ $person->name }}
                                    <small class="text-muted">({{ ucfirst($person->type) }})</small>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('authors')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="bg-light p-2 mt-2">
                            <small class="text-muted">If Author is not in 'our-people'</small>
                            <input type="text" 
                                class="form-control mt-2 @error('author_name') is-invalid @enderror" 
                                name="author_name" 
                                placeholder="Author Name" 
                                value="{{ old('author_name', $blog->author_name) }}">
                            @error('author_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <small class="text-muted p-1">Optional: Leave empty if anonymous</small>
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
                            <option value="{{ $category->id }}" 
                                    {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
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
                                       {{ in_array($tag->id, old('tags', $blog->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                        @if($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                             class="img-fluid rounded mb-3" 
                             alt="Current featured image">
                        @endif
                        <input type="file" 
                               class="form-control @error('featured_image') is-invalid @enderror" 
                               name="featured_image" id="featured_image"
                               accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
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
                                   value="{{ old('reading_time', $blog->reading_time) }}" 
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
                            <i class="fas fa-save me-2"></i>Update Blog Post
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