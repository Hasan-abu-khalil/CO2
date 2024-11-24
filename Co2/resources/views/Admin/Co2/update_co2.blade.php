<div class="modal fade" id="updateCo2Modal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <form id="updateCo2Form" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Update Co2</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group my-2">
                            <label for="up_percentage_id">Percentage Amount</label>
                            <select class="form-control border-2 border-bottom" id="up_percentage_id" name="percentage_id"
                                required>
                                <option value="">Select Source</option>
                                @foreach($percentages as $percentage)
                                    <option value="{{ $percentage->id }}">{{ $percentage->amount }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group my-2">
                            <label for="up_product_id">Product</label>
                            <select class="form-control border-2 border-bottom" id="up_product_id" name="product_id"
                                required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group my-2">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control border-2 border-bottom" id="up_unit" name="unit"
                                required>
                        </div>

                        <div class="form-group my-2">
                            <label for="up_amount">Amount (%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="up_amount"
                                name="amount" step="0.01" min="0" max="100" required>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>