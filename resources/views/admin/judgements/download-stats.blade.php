@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Download Statistics</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.judgements.index') }}">Judgements</a></li>
                    <li class="breadcrumb-item active">Download Stats: {{ $judgement->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Judgement Summary --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-2">{{ $judgement->title }}</h4>
                    @if($judgement->case_number)
                        <p class="mb-1"><strong>Case Number:</strong> {{ $judgement->case_number }}</p>
                    @endif
                    @if($judgement->court)
                        <p class="mb-1"><strong>Court:</strong> {{ $judgement->court }}</p>
                    @endif
                    @if($judgement->judgement_date)
                        <p class="mb-1"><strong>Date:</strong> {{ $judgement->judgement_date->format('M d, Y') }}</p>
                    @endif
                </div>
                <div class="col-md-4 text-end">
                    <div class="download-summary">
                        <h2 class="mb-0 text-danger">{{ $judgement->download_count }}</h2>
                        <p class="text-muted mb-0">Total Downloads</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistics Overview --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fa fa-download text-primary" style="font-size: 2rem;"></i>
                    <h4 class="mt-2 mb-0">{{ $judgement->download_count }}</h4>
                    <small class="text-muted">Total Downloads</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fa fa-calendar-check text-success" style="font-size: 2rem;"></i>
                    <h4 class="mt-2 mb-0">{{ $downloads->count() }}</h4>
                    <small class="text-muted">Recent Downloads</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fa fa-file-earmark text-info" style="font-size: 2rem;"></i>
                    <h4 class="mt-2 mb-0">{{ strtoupper($judgement->file_type) }}</h4>
                    <small class="text-muted">File Type</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fa fa-hdd text-warning" style="font-size: 2rem;"></i>
                    <h4 class="mt-2 mb-0">{{ $judgement->formatted_file_size }}</h4>
                    <small class="text-muted">File Size</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Download History --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Download History</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Date & Time</th>
                        <th>IP Address</th>
                        <th>Browser</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($downloads as $index => $download)
                    <tr>
                        <td>{{ $downloads->firstItem() + $index }}</td>
                        <td>
                            <strong>{{ $download->downloaded_at->format('M d, Y') }}</strong><br>
                            <small class="text-muted">{{ $download->downloaded_at->format('h:i A') }}</small>
                        </td>
                        <td>
                            <code>{{ $download->ip_address }}</code>
                        </td>
                        <td>
                            @if($download->user_agent)
                                @php
                                    $agent = $download->user_agent;
                                    $browser = 'Unknown';
                                    
                                    if (str_contains($agent, 'Chrome')) $browser = 'Chrome';
                                    elseif (str_contains($agent, 'Firefox')) $browser = 'Firefox';
                                    elseif (str_contains($agent, 'Safari')) $browser = 'Safari';
                                    elseif (str_contains($agent, 'Edge')) $browser = 'Edge';
                                    elseif (str_contains($agent, 'Opera')) $browser = 'Opera';
                                @endphp
                                <i class="fa fa-browser-{{ strtolower($browser) == 'chrome' ? 'chrome' : 'edge' }}"></i>
                                {{ $browser }}
                            @else
                                <span class="text-muted">Unknown</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ $download->downloaded_at->diffForHumans() }}</small>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fa fa-inbox" style="font-size: 2rem; color: #ccc;"></i>
                            <p class="text-muted mt-2 mb-0">No downloads yet</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($downloads->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $downloads->links() }}
            </div>
        </div>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.judgements.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back to Judgements
        </a>
        <a href="{{ $judgement->file_url }}" class="btn btn-outline-primary" target="_blank">
            <i class="fa fa-eye"></i> View File
        </a>
    </div>
</div>

<style>
.download-summary h2 {
    font-size: 3rem;
    font-weight: 700;
}

.card-body i {
    opacity: 0.8;
}

code {
    font-size: 0.9rem;
    background: #f8f9fa;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
}
</style>
@endsection