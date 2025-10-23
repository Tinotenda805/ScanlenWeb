@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">{{ isset($person) ? 'Edit' : 'Add' }} Team Member</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.people.index') }}">Our People</a></li>
                    <li class="breadcrumb-item active">{{ isset($person) ? 'Edit' : 'Add' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ isset($person) ? route('admin.people.update', $person) : route('admin.people.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($person))
            @method('PUT')
        @endif

        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Basic Information --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $person->name ?? '') }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('designation') is-invalid @enderror" 
                                       id="designation" 
                                       name="designation" 
                                       value="{{ old('designation', $person->designation ?? '') }}"
                                       placeholder="e.g., Senior Partner, Associate"
                                       required>
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" 
                                   class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" 
                                   name="slug" 
                                   value="{{ old('slug', $person->slug ?? '') }}"
                                   placeholder="Leave blank to auto-generate">
                            <small class="text-muted">URL-friendly version of the name</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $person->email ?? '') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $person->phone ?? '') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="linkedin" class="form-label">LinkedIn URL</label>
                                <input type="url" 
                                       class="form-control @error('linkedin') is-invalid @enderror" 
                                       id="linkedin" 
                                       name="linkedin" 
                                       value="{{ old('linkedin', $person->linkedin ?? '') }}"
                                       placeholder="https://linkedin.com/in/username">
                                @error('linkedin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp Number</label>
                                <input type="text" 
                                       class="form-control @error('whatsapp') is-invalid @enderror" 
                                       id="whatsapp" 
                                       name="whatsapp" 
                                       value="{{ old('whatsapp', $person->whatsapp ?? '') }}"
                                       placeholder="+263...">
                                @error('whatsapp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       id="location" 
                                       name="location" 
                                       value="{{ old('location', $person->location ?? 'Harare, ZW') }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="languages" class="form-label">Languages</label>
                                <input type="text" 
                                       class="form-control @error('languages') is-invalid @enderror" 
                                       id="languages" 
                                       name="languages" 
                                       value="{{ old('languages', $person->languages ?? '') }}"
                                       placeholder="English, Shona, Ndebele">
                                @error('languages')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Short Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      id="bio" 
                                      name="bio" 
                                      rows="3">{{ old('bio', $person->bio ?? '') }}</textarea>
                            <small class="text-muted">Brief introduction (for listing pages)</small>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_overview" class="form-label">Profile Overview</label>
                            <textarea class="form-control @error('profile_overview') is-invalid @enderror" 
                                      id="profile_overview" 
                                      name="profile_overview" 
                                      rows="6">{{ old('profile_overview', $person->profile_overview ?? '') }}</textarea>
                            <small class="text-muted">Detailed profile (for detail page)</small>
                            @error('profile_overview')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Quick Facts --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Facts</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="years_of_experience" class="form-label">Years of Experience</label>
                                <input type="number" 
                                       class="form-control @error('years_of_experience') is-invalid @enderror" 
                                       id="years_of_experience" 
                                       name="years_of_experience" 
                                       value="{{ old('years_of_experience', $person->years_of_experience ?? '') }}"
                                       min="0">
                                @error('years_of_experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="deals_completed" class="form-label">Deals Completed</label>
                                <input type="number" 
                                       class="form-control @error('deals_completed') is-invalid @enderror" 
                                       id="deals_completed" 
                                       name="deals_completed" 
                                       value="{{ old('deals_completed', $person->deals_completed ?? '') }}"
                                       min="0">
                                @error('deals_completed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Areas of Expertise --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Areas of Expertise</h5>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addExpertiseArea()">
                            <i class="fa fa-plus"></i> Add Area
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="expertise-areas-container">
                            @php
                                $areasOfExpertise = old('areas_of_expertise', $person->areas_of_expertise ?? []);
                            @endphp
                            @if(count($areasOfExpertise) > 0)
                                @foreach($areasOfExpertise as $index => $area)
                                    <div class="expertise-area-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="areas_of_expertise[{{ $index }}][title]" 
                                                       value="{{ $area['title'] ?? '' }}"
                                                       placeholder="Title">
                                            </div>
                                            <div class="col-md-7">
                                                <textarea class="form-control" 
                                                          name="areas_of_expertise[{{ $index }}][description]" 
                                                          rows="2"
                                                          placeholder="Description">{{ $area['description'] ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.expertise-area-item').remove()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No areas of expertise added yet. Click "Add Area" to start.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Professional Experience Timeline --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Professional Experience</h5>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addExperience()">
                            <i class="fa fa-plus"></i> Add Experience
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="experience-container">
                            @php
                                $experiences = old('professional_experience', $person->professional_experience ?? []);
                            @endphp
                            @if(count($experiences) > 0)
                                @foreach($experiences as $index => $exp)
                                    <div class="experience-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="professional_experience[{{ $index }}][period]" 
                                                       value="{{ $exp['period'] ?? '' }}"
                                                       placeholder="2018 - Present">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="professional_experience[{{ $index }}][role]" 
                                                       value="{{ $exp['role'] ?? '' }}"
                                                       placeholder="Role/Position">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="professional_experience[{{ $index }}][company]" 
                                                       value="{{ $exp['company'] ?? '' }}"
                                                       placeholder="Company">
                                            </div>
                                            <div class="col-md-1 mb-2">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.experience-item').remove()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" 
                                                          name="professional_experience[{{ $index }}][description]" 
                                                          rows="2"
                                                          placeholder="Description">{{ $exp['description'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No experience added yet. Click "Add Experience" to start.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Qualifications --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Qualifications & Education</h5>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addQualification()">
                            <i class="fa fa-plus"></i> Add Qualification
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="qualifications-container">
                            @php
                                $qualifications = old('qualifications', $person->qualifications ?? []);
                            @endphp
                            @if(count($qualifications) > 0)
                                @foreach($qualifications as $index => $qual)
                                    <div class="qualification-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-5 mb-2">
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="qualifications[{{ $index }}][title]" 
                                                       value="{{ $qual['title'] ?? '' }}"
                                                       placeholder="Degree/Certification Title">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="qualifications[{{ $index }}][institution]" 
                                                       value="{{ $qual['institution'] ?? '' }}"
                                                       placeholder="Institution">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="qualifications[{{ $index }}][year]" 
                                                       value="{{ $qual['year'] ?? '' }}"
                                                       placeholder="Year">
                                            </div>
                                            <div class="col-md-1 mb-2">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.qualification-item').remove()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" 
                                                          name="qualifications[{{ $index }}][details]" 
                                                          rows="2"
                                                          placeholder="Additional details">{{ $qual['details'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No qualifications added yet. Click "Add Qualification" to start.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Settings --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" 
                                    name="type" 
                                    required>
                                <option value="partner" {{ old('type', $person->type ?? '') === 'partner' ? 'selected' : '' }}>Partner</option>
                                <option value="associate" {{ old('type', $person->type ?? '') === 'associate' ? 'selected' : '' }}>Associate</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="active" {{ old('status', $person->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $person->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', $person->order ?? 0) }}"
                                   min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-save"></i> {{ isset($person) ? 'Update' : 'Create' }}
                        </button>
                        <a href="{{ route('admin.people.index') }}" class="btn btn-secondary w-100 mt-2">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Avatar Image --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Profile Image</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($person) && $person->avatar)
                        <div class="mb-3 text-center">
                            <img src="{{ $person->avatar_url }}" 
                                 alt="Current Avatar" 
                                 class="img-fluid rounded"
                                 style="max-height: 200px;">
                            <p class="text-muted small mt-2">Current Image</p>
                        </div>
                        @endif

                        <input type="file" 
                               class="form-control @error('avatar') is-invalid @enderror" 
                               id="avatar" 
                               name="avatar" 
                               accept="image/*"
                               onchange="previewImage(this, 'avatarPreview')">
                        <small class="text-muted">Recommended: 400x400px</small>
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="avatarPreview" class="mt-3 text-center d-none">
                            <p class="text-success small mb-2">New Image Preview:</p>
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
                        @if(isset($person) && $person->banner_image)
                        <div class="mb-3 text-center">
                            <img src="{{ $person->banner_url }}" 
                                 alt="Current Banner" 
                                 class="img-fluid rounded"
                                 style="max-height: 150px;">
                            <p class="text-muted small mt-2">Current Banner</p>
                        </div>
                        @endif

                        <input type="file" 
                               class="form-control @error('banner_image') is-invalid @enderror" 
                               id="banner_image" 
                               name="banner_image" 
                               accept="image/*"
                               onchange="previewImage(this, 'bannerPreview')">
                        <small class="text-muted">For profile header. Recommended: 1920x600px</small>
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="bannerPreview" class="mt-3 text-center d-none">
                            <p class="text-success small mb-2">New Banner Preview:</p>
                            <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
let expertiseIndex = {{ count(old('areas_of_expertise', $person->areas_of_expertise ?? [])) }};
let experienceIndex = {{ count(old('professional_experience', $person->professional_experience ?? [])) }};
let qualificationIndex = {{ count(old('qualifications', $person->qualifications ?? [])) }};

// Add Expertise Area
function addExpertiseArea() {
    const container = document.getElementById('expertise-areas-container');
    const html = `
        <div class="expertise-area-item mb-3 p-3 border rounded">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" 
                           class="form-control" 
                           name="areas_of_expertise[${expertiseIndex}][title]" 
                           placeholder="Title">
                </div>
                <div class="col-md-7">
                    <textarea class="form-control" 
                              name="areas_of_expertise[${expertiseIndex}][description]" 
                              rows="2"
                              placeholder="Description"></textarea>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.expertise-area-item').remove()">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    expertiseIndex++;
}

// Add Experience
function addExperience() {
    const container = document.getElementById('experience-container');
    const html = `
        <div class="experience-item mb-3 p-3 border rounded">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <input type="text" 
                           class="form-control" 
                           name="professional_experience[${experienceIndex}][period]" 
                           placeholder="2018 - Present">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" 
                           class="form-control" 
                           name="professional_experience[${experienceIndex}][role]" 
                           placeholder="Role/Position">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" 
                           class="form-control" 
                           name="professional_experience[${experienceIndex}][company]" 
                           placeholder="Company">
                </div>
                <div class="col-md-1 mb-2">
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.experience-item').remove()">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="col-12">
                    <textarea class="form-control" 
                              name="professional_experience[${experienceIndex}][description]" 
                              rows="2"
                              placeholder="Description"></textarea>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    experienceIndex++;
}

// Add Qualification
function addQualification() {
    const container = document.getElementById('qualifications-container');
    const html = `
        <div class="qualification-item mb-3 p-3 border rounded">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <input type="text" 
                           class="form-control" 
                           name="qualifications[${qualificationIndex}][title]" 
                           placeholder="Degree/Certification Title">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" 
                           class="form-control" 
                           name="qualifications[${qualificationIndex}][institution]" 
                           placeholder="Institution">
                </div>
                <div class="col-md-2 mb-2">
                    <input type="text" 
                           class="form-control" 
                           name="qualifications[${qualificationIndex}][year]" 
                           placeholder="Year">
                </div>
                <div class="col-md-1 mb-2">
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.qualification-item').remove()">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="col-12">
                    <textarea class="form-control" 
                              name="qualifications[${qualificationIndex}][details]" 
                              rows="2"
                              placeholder="Additional details"></textarea>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    qualificationIndex++;
}

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

// Auto-generate slug from name
// document.getElementById('name')?.addEventListener('blur', function() {
//     const slugInput = document.getElementById('slug');
//     if (!slugInput.value) {
//         slugInput.value = this.value
//             .toLowerCase()
//             .replace(/[^a-z0-9]+/g, '-')
//             .replace(/^-+|-+$/g, '');
//     }
// });
</script>

<style>
.card-header h5 {
    font-size: 1.1rem;
    font-weight: 600;
}

.expertise-area-item,
.experience-item,
.qualification-item {
    background: #f8f9fa;
}
</style>
@endsection