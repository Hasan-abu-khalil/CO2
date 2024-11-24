$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var PercentageTable = $("#PercentagesTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/Percentages",
        columns: [
            { data: "id", name: "id" },
            { data: "source_name", name: "source_name" },
            { data: "product_name", name: "product_name" },
            { data: "amount", name: "amount" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("#addPercentageForm").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/Percentages",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                $("#addPercentageModal").modal("hide");
                $("#addPercentageForm")[0].reset();
                PercentageTable.ajax.reload();
                toastr.success("Percentage added successfully");
            },
            error: function (res) {
                if (res.responseJSON && res.responseJSON.errors) {
                    var errors = res.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(
                        " An error occurred while updating the Percentage"
                    );
                }
            },
        });
    });

    $(document).on("click", ".edit", function () {
        var id = $(this).data("id");
        $.get("/Percentages/" + id + "/edit", function (data) {
            $("#updatePercentageForm #up_amount").val(data.amount);
            $("#updatePercentageForm #up_source_id").val(data.source_id);
            $("#updatePercentageForm #up_product_id").val(data.product_id);
            $("#updatePercentageForm").data("id", data.id);
            $("#updatePercentageModal").modal("show");
        });
    });

    $("#updatePercentageForm").on("submit", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/Percentages/" + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#updatePercentageModal").modal("hide");
                PercentageTable.ajax.reload();
                toastr.success("Percentage Updated Successfully!");
            },
            error: function (response) {
                if (response.responseJSON && response.responseJSON.errors) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(
                        "An error occurred while updating the Percentage."
                    );
                }
            },
        });
    });

    $(document).on("click", ".deletePercentage", function () {
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
                    url: "/Percentages/" + id,
                    success: function (response) {
                        PercentageTable.ajax.reload();
                        toastr.success("Percentage deleted successfully!");
                    },
                    error: function (response) {
                        toastr.error("Failed to delete Percentage!");
                    },
                });
            }
        });
    });
});
