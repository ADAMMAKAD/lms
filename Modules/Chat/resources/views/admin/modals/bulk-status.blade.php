<!-- Bulk Status Modal -->
<div class="modal fade" id="bulkStatusModal" tabindex="-1" aria-labelledby="bulkStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkStatusModalLabel">Update Chat Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bulk-status-form">
                    <div class="mb-3">
                        <label for="bulk-status-select" class="form-label">Select Status</label>
                        <select class="form-select" id="bulk-status-select" required>
                            <option value="open">Open</option>
                            <option value="in_progress">In Progress</option>
                            <option value="resolved">Resolved</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <span id="selected-status-count">0</span> chat(s) will be updated to the selected status.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="performBulkStatusUpdate()">Update Status</button>
            </div>
        </div>
    </div>
</div>

<script>
function showBulkStatusModal() {
    const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
    if (checkedCheckboxes.length === 0) {
        alert('Please select at least one chat.');
        return;
    }
    
    document.getElementById('selected-status-count').textContent = checkedCheckboxes.length;
    const modal = new bootstrap.Modal(document.getElementById('bulkStatusModal'));
    modal.show();
}

function performBulkStatusUpdate() {
    const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
    const chatIds = Array.from(checkedCheckboxes).map(cb => cb.value);
    const status = document.getElementById('bulk-status-select').value;
    
    if (chatIds.length === 0) {
        alert('Please select at least one chat.');
        return;
    }
    
    performBulkAction('update_status', { chat_ids: chatIds, status: status });
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('bulkStatusModal'));
    modal.hide();
}
</script>