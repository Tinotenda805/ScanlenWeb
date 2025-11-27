<div class="modal fade" id="editModal{{ $type->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST"
              action="{{ route('admin.employee-types.update', $type) }}">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Employee Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name"
                           value="{{ $type->name }}"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ $type->description }}</textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
