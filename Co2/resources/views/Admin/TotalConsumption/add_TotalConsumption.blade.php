<div class="modal fade" id="addTotalConsumptionModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <form id="addTotalConsumptionForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Total Consumption</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form fields here -->
                        <div class="form-group my-2">
                            <label for="q1">Q1 (%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="q1" name="q1"
                                step="0.01" min="0" max="100" required>
                        </div>

                        <div class="form-group my-2">
                            <label for="q2">Q2(%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="q2" name="q2"
                                step="0.01" min="0" max="100" required>
                        </div>

                        <div class="form-group my-2">
                            <label for="q3">Q3(%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="q3" name="q3"
                                step="0.01" min="0" max="100" required>
                        </div>

                        <div class="form-group my-2">
                            <label for="q4">Q4 (%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="q4" name="q4"
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