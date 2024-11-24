<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <form id="addProductForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form fields here -->
                        <div class="form-group my-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control border-2 border-bottom" id="name" name="name"
                                required>
                        </div>
                        <div class="form-group my-2">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control border-2 border-bottom" id="unit" name="unit"
                                required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>