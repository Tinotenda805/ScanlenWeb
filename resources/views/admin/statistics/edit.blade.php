@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Edit Statistic</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistics.index') }}">Statistics</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Statistic Information</h5>
                    </div>
                    <div class="card-body">
                        {{-- Label --}}
                        <div class="mb-3">
                            <label for="label" class="form-label">Label <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('label') is-invalid @enderror" 
                                   id="label" 
                                   name="label" 
                                   value="{{ old('label', $statistic->label) }}"
                                   required>
                            @error('label')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Value --}}
                        <div class="mb-3">
                            <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('value') is-invalid @enderror" 
                                   id="value" 
                                   name="value" 
                                   value="{{ old('value', $statistic->value) }}"
                                   required>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Icon --}}
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Optional)</label>
                            <input type="text" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon" 
                                   name="icon" 
                                   value="{{ old('icon', $statistic->icon) }}">
                            <small class="text-muted">
                                Bootstrap Icons class. Browse: 
                                <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a>
                            </small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Icon Preview --}}
                        <div id="iconPreview" class="alert alert-info {{ $statistic->icon ? '' : 'd-none' }}">
                            <strong>Icon Preview:</strong><br>
                            <i id="previewIcon" class="{{ $statistic->icon }}" style="font-size: 2rem; color: #dc3545;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                {{-- Publish Settings --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Settings</h5>
                    </div>
                    <div class="card-body">
                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="active" {{ old('status', $statistic->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $statistic->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                                   value="{{ old('order', $statistic->order) }}"
                                   min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-save"></i> Update Statistic
                        </button>
                        <a href="{{ route('admin.statistics.index') }}" class="btn btn-secondary w-100 mt-2">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Common Icons Quick Reference --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Common Icons</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa fa-calendar-check')">
                                <i class="fa fa-calendar-check"></i> Calendar
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa fa-users')">
                                <i class="fa fa-users"></i> People
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa fa-check-circle')">
                                <i class="fa fa-check-circle"></i> Check
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa fa-briefcase')">
                                <i class="fa fa-briefcase"></i> Briefcase
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa fa-award')">
                                <i class="fa fa-award"></i> Award
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa fa-trophy')">
                                <i class="fa fa-trophy"></i> Trophy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Icon preview
const iconInput = document.getElementById('icon');
const iconPreview = document.getElementById('iconPreview');
const previewIcon = document.getElementById('previewIcon');

iconInput.addEventListener('input', function() {
    if (this.value) {
        previewIcon.className = this.value;
        iconPreview.classList.remove('d-none');
    } else {
        iconPreview.classList.add('d-none');
    }
});

// Set icon from quick buttons
function setIcon(iconClass) {
    iconInput.value = iconClass;
    iconInput.dispatchEvent(new Event('input'));
}
</script>
@endsection