@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <h1>Edit Article</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">Articles</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Article Details</h5>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $article->title) }}" 
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
                                      required>{{ old('excerpt', $article->excerpt) }}</textarea>
                            @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content *</label>
                            <div id="editor" style="height: 600px;"></div>
                            <input type="hidden" id="content" name="content" value="{{ old('content', $article->content) ?? '' }}">
                            {{-- <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" 
                                      name="content" 
                                      rows="15" 
                                      required>{{ old('content', $article->content) }}</textarea> --}}
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- SEO & Readability Panel -->
                @include('admin.articles.seo-panel')
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
                                       {{ old('is_published', $article->is_published) ? 'checked' : '' }}>
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
                                       {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="datetime-local" 
                                   class="form-control @error('published_at') is-invalid @enderror" 
                                   id="published_at" 
                                   name="published_at" 
                                   value="{{ old('published_at', $article->published_at->format('Y-m-d\TH:i')) }}">
                            @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Authors -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Authors *</h5>
                        <div style="max-height: 200px; overflow-y: auto;">
                            @foreach($people as $person)
                            <div class="form-check mb-2">
                                <input class="form-check-input @error('authors') is-invalid @enderror" 
                                       type="checkbox" 
                                       name="authors[]" 
                                       value="{{ $person->id }}" 
                                       id="author{{ $person->id }}"
                                       {{ in_array($person->id, old('authors', $article->authors->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                            <option value="{{ $category->id }}" 
                                    {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
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
                                       {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                        @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
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
                                   value="{{ old('reading_time', $article->reading_time_raw ?? 1) }}"
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
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-save me-2"></i>Update Article
                        </button>
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary w-100">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection