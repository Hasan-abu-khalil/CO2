$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var TotalConsumptionTable = $("#TotalConsumptionTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/TotalConsumption",
        columns: [
            { data: "id", name: "id" },
            { data: "q1", name: "q1" },
            { data: "q2", name: "q2" },
            { data: "q3", name: "q3" },
            { data: "q4", name: "q4" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("#addTotalConsumptionForm").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/TotalConsumption",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                $("#addTotalConsumptionModal").modal("hide");
                $("#addTotalConsumptionForm")[0].reset();
                TotalConsumptionTable.ajax.reload();
                toastr.success("TotalConsumption added successfully");
            },
            error: function (res) {
                if (res.responseJSON && res.responseJSON.errors) {
                    var errors = res.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(
                        " An error occurred while updating the TotalConsumption"
                    );
                }
            },
        });
    });

    $(document).on("click", ".edit", function () {
        var id = $(this).data("id");
        $.get("/TotalConsumption/" + id + "/edit", function (data) {
            $("#updateTotalConsumptionForm #up_q1").val(data.q1);
            $("#updateTotalConsumptionForm #up_q2").val(data.q2);
            $("#updateTotalConsumptionForm #up_q3").val(data.q3);
            $("#updateTotalConsumptionForm #up_q4").val(data.q4);
            $("#updateTotalConsumptionForm").data("id", data.id);
            $("#updateTotalConsumptionModal").modal("show");
        });
    });

    $("#updateTotalConsumptionForm").on("submit", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/TotalConsumption/" + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#updateTotalConsumptionModal").modal("hide");
                TotalConsumptionTable.ajax.reload();
                toastr.success("TotalConsumption Updated Successfully!");
            },
            error: function (response) {
                if (response.responseJSON && response.responseJSON.errors) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(
                        "An error occurred while updating the TotalConsumption."
                    );
                }
            },
        });
    });

    $(document).on("click", ".deleteTotalConsumption", function () {
        var id = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/TotalConsumption/" + id,
                    success: function (response) {
                        TotalConsumptionTable.ajax.reload();
                        toastr.success(
                            "TotalConsumption deleted successfully!"
                        );
                    },
                    error: function (response) {
                        toastr.error("Failed to delete TotalConsumption!");
                    },
                });
            }
        });
    });
});
