@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Message Details</h1>
        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back to Messages
        </a>
    </div>


    <div class="row">
        <div class="col-lg-8">
            <!-- Message Content -->
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fa fa-envelope-open"></i> {{ $contactMessage->subject }}
                        </h5>
                        @if($contactMessage->status === 'unread')
                        <span class="badge bg-warning text-dark">Unread</span>
                        @elseif($contactMessage->status === 'read')
                        <span class="badge bg-info">Read</span>
                        @else
                        <span class="badge bg-success">Replied</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>From:</strong> {{ $contactMessage->name }}
                                </p>
                                <p class="mb-2">
                                    <strong>Email:</strong> 
                                    <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Received:</strong> {{ $contactMessage->created_at->format('M d, Y H:i:s') }}
                                </p>
                                <p class="mb-2">
                                    <strong>IP Address:</strong> {{ $contactMessage->ip_address ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Message:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($contactMessage->message)) !!}
                        </div>
                    </div>

                    <!-- Quick Reply Section -->
                    <div class="mt-4">
                        <h6 class="mb-3">Quick Reply</h6>
                        <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}" 
                           class="btn btn-primary">
                            <i class="fa fa-reply"></i> Reply via Email
                        </a>
                    </div>
                </div>
            </div>

            <!-- Admin Notes -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Admin Notes</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.contact-messages.update-status', $contactMessage) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">Notes (internal use only)</label>
                            <textarea class="form-control @error('admin_notes') is-invalid @enderror" 
                                      id="admin_notes" 
                                      name="admin_notes" 
                                      rows="4"
                                      placeholder="Add internal notes about this message...">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea>
                            @error('admin_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="unread" {{ old('status', $contactMessage->status) === 'unread' ? 'selected' : '' }}>Unread</option>
                                <option value="read" {{ old('status', $contactMessage->status) === 'read' ? 'selected' : '' }}>Read</option>
                                <option value="replied" {{ old('status', $contactMessage->status) === 'replied' ? 'selected' : '' }}>Replied</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-circle"></i> Update
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Quick Info -->
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Quick Info</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Current Status</small>
                        @if($contactMessage->status === 'unread')
                        <span class="badge bg-warning text-dark">Unread</span>
                        @elseif($contactMessage->status === 'read')
                        <span class="badge bg-info">Read</span>
                        @else
                        <span class="badge bg-success">Replied</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Received</small>
                        <strong>{{ $contactMessage->created_at->diffForHumans() }}</strong>
                        <br><small>{{ $contactMessage->created_at->format('M d, Y H:i') }}</small>
                    </div>

                    @if($contactMessage->read_at)
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Read At</small>
                        <strong>{{ $contactMessage->read_at->diffForHumans() }}</strong>
                        <br><small>{{ $contactMessage->read_at->format('M d, Y H:i') }}</small>
                    </div>
                    @endif

                    <div>
                        <small class="text-muted d-block mb-1">IP Address</small>
                        <strong>{{ $contactMessage->ip_address ?? 'N/A' }}</strong>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="mailto:{{ $contactMessage->email }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-envelope"></i> Send Email
                        </a>
                        
                        @if($contactMessage->status !== 'replied')
                        <form action="{{ route('admin.contact-messages.update-status', $contactMessage) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="replied">
                            <button type="submit" class="btn btn-success btn-sm w-100">
                                <i class="fa fa-check-circle"></i> Mark as Replied
                            </button>
                        </form>
                        @endif

                        @if($contactMessage->status !== 'read')
                        <form action="{{ route('admin.contact-messages.update-status', $contactMessage) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="read">
                            <button type="submit" class="btn btn-info btn-sm w-100">
                                <i class="fa fa-eye"></i> Mark as Read
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-2">Delete this message permanently.</p>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteMessage()">
                        <i class="fa fa-trash"></i> Delete Message
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function deleteMessage() {
    if (confirm('Are you sure you want to delete this message? This action cannot be undone.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection