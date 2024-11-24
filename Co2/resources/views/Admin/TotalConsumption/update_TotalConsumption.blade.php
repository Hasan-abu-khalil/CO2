<div class="modal fade" id="updateTotalConsumptionModal" tabindex="-1" aria-labelledby="addModalLabel"
    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <form id="updateTotalConsumptionForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Update Total Consumption</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group my-2">
                            <label for="up_q1">Q1 (%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="up_q1" name="q1"
                                step="0.01" min="0" max="100" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="up_q2">Q2 (%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="up_q2" name="q2"
                                step="0.01" min="0" max="100" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="up_q3">Q3 (%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="up_q3" name="q3"
                                step="0.01" min="0" max="100" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="up_q4">Q4 (%)</label>
                            <input type="number" class="form-control border-2 border-bottom" id="up_q4" name="q4"
                                step="0.01" min="0" max="100" required>
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