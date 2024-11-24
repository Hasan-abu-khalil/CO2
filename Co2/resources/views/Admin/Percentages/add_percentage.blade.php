<div class="modal fade" id="addPercentageModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <form id="addPercentageForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Percentage</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form fields here -->
                        <div class="form-group my-2">
                            <label for="source_id">Source</label>
                            <select class="form-control border-2 border-bottom" id="source_id" name="source_id"
                                required>
                                <option value="">Select Source</option>
                                @foreach($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        
                        <div class="form-group my-2">
                            <label for="product_id">Product</label>
                            <select class="form-control border-2 border-bottom" id="product_id" name="product_id"
                                required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Amount field -->
                        <div class="form-group my-2">
                            <label for="amount">Amount (%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="amount" name="amount"
                                step="0.01" min="0" max="100" required>
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

