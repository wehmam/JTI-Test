<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit No Handphone</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <form>
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">No Handphone</label>
            <input type="number" class="form-control" id="phoneNumber">
        </div>
        <div class="mb-3">
            <label for="provider" class="form-label">Provider</label>
            <select class="form-select form-control" aria-label="Default select example" id="provider">
                <option value="xl">XL</option>
                <option value="indosat">Indosat</option>
                <option value="tri">Tri</option>
            </select>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveEdit">Save</button>
    </div>
    </div>
</div>
</div>
