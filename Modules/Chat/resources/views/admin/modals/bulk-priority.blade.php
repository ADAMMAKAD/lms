<!-- Bulk Priority Modal -->
<div class="modal fade" id="bulkPriorityModal" tabindex="-1" aria-labelledby="bulkPriorityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkPriorityModalLabel">Update Chat Priority</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bulk-priority-form">
                    <div class="mb-3">
                        <label for="bulk-priority-select" class="form-label">Select Priority</label>
                        <select class="form-select" id="bulk-priority-select" required>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <span id="selected-priority-count">0</span> chat(s) will be updated to the selected priority.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="performBulkPriorityUpdate()">Update Priority</button>
            </div>
        </div>
    </div>
</div>

<script>
function showBulkPriorityModal() {
    const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
    if (checkedCheckboxes.length === 0) {
        alert('Please select at least one chat.');
        return;
    }
    
    document.getElementById('selected-priority-count').textContent = checkedCheckboxes.length;
    const modal = new bootstrap.Modal(document.getElementById('bulkPriorityModal'));
    modal.show();
}

function performBulkPriorityUpdate() {
    const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
    const chatIds = Array.from(checkedCheckboxes).map(cb => cb.value);
    const priority = document.getElementById('bulk-priority-select').value;
    
    if (chatIds.length === 0) {
        alert('Please select at least one chat.');
        return;
    }
    
    performBulkAction('update_priority', { chat_ids: chatIds, priority: priority });
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('bulkPriorityModal'));
    modal.hide();
}
</script>