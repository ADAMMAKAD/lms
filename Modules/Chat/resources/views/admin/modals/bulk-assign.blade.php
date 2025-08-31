<!-- Bulk Assign Modal -->
<div class="modal fade" id="bulkAssignModal" tabindex="-1" aria-labelledby="bulkAssignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkAssignModalLabel">Assign Chats to Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bulk-assign-form">
                    <div class="mb-3">
                        <label for="bulk-admin-select" class="form-label">Select Admin</label>
                        <select class="form-select" id="bulk-admin-select" required>
                            <option value="">Unassigned</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <span id="selected-count">0</span> chat(s) will be assigned to the selected admin.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="performBulkAssign()">Assign Chats</button>
            </div>
        </div>
    </div>
</div>

<script>
function showBulkAssignModal() {
    const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
    if (checkedCheckboxes.length === 0) {
        alert('Please select at least one chat.');
        return;
    }
    
    document.getElementById('selected-count').textContent = checkedCheckboxes.length;
    const modal = new bootstrap.Modal(document.getElementById('bulkAssignModal'));
    modal.show();
}

function performBulkAssign() {
    const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
    const chatIds = Array.from(checkedCheckboxes).map(cb => cb.value);
    const adminId = document.getElementById('bulk-admin-select').value;
    
    if (chatIds.length === 0) {
        alert('Please select at least one chat.');
        return;
    }
    
    performBulkAction('assign', { chat_ids: chatIds, admin_id: adminId });
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('bulkAssignModal'));
    modal.hide();
}
</script>