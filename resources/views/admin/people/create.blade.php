@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <h1>Add New Person</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.people.index') }}">Our People</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.people.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Personal Information</h5>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      id="bio" 
                                      name="bio" 
                                      rows="4">{{ old('bio') }}</textarea>
                            <small class="text-muted">Brief professional biography</small>
                            @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Social Media Links</h5>
                        
                        <div class="mb-3">
                            <label for="twitter" class="form-label">
                                <i class="fab fa-twitter text-info me-1"></i> Twitter URL
                            </label>
                            <input type="url" 
                                   class="form-control @error('twitter') is-invalid @enderror" 
                                   id="twitter" 
                                   name="twitter" 
                                   value="{{ old('twitter') }}"
                                   placeholder="https://twitter.com/username">
                            @error('twitter')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="linkedin" class="form-label">
                                <i class="fab fa-linkedin text-primary me-1"></i> LinkedIn URL
                            </label>
                            <input type="url" 
                                   class="form-control @error('linkedin') is-invalid @enderror" 
                                   id="linkedin" 
                                   name="linkedin" 
                                   value="{{ old('linkedin') }}"
                                   placeholder="https://linkedin.com/in/username">
                            @error('linkedin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Type -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Type *</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input @error('type') is-invalid @enderror" 
                                   type="radio" 
                                   name="type" 
                                   id="typePartner" 
                                   value="partner" 
                                   {{ old('type') === 'partner' ? 'checked' : '' }}
                                   required>
                            <label class="form-check-label" for="typePartner">
                                <strong>Partner</strong>
                                <small class="d-block text-muted">Senior level position</small>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('type') is-invalid @enderror" 
                                   type="radio" 
                                   name="type" 
                                   id="typeAssociate" 
                                   value="associate" 
                                   {{ old('type') === 'associate' ? 'checked' : '' }}
                                   required>
                            <label class="form-check-label" for="typeAssociate">
                                <strong>Associate</strong>
                                <small class="d-block text-muted">Junior/Mid level position</small>
                            </label>
                        </div>
                        @error('type')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Avatar -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Profile Photo</h5>
                        <input type="file" 
                               class="form-control @error('avatar') is-invalid @enderror" 
                               name="avatar" 
                               accept="image/*">
                        <small class="text-muted d-block mt-2">Recommended: Square image, min 300x300px</small>
                        @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <button type="submit" class="btn btn-info w-100 mb-2">
                            <i class="fas fa-save me-2"></i>Add Person
                        </button>
                        <a href="{{ route('admin.people.index') }}" class="btn btn-secondary w-100">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection