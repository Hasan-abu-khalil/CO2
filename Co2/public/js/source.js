$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var SourcesTable = $("#SourcesTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/Sources",
        columns: [
            { data: "id", name: "id" },
            { data: "name", name: "name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("#addSourceForm").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/Sources",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                $("#addSourceModal").modal("hide");
                $("#addSourceForm")[0].reset();
                SourcesTable.ajax.reload();
                toastr.success("source added successfully");
            },
            error: function (res) {
                if (res.responseJSON && res.responseJSON.errors) {
                    var errors = res.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(
                        " An error occurred while updating the Source"
                    );
                }
            },
        });     
    });

    $(document).on("click", ".edit", function () {
        var id = $(this).data("id"); 
        $.get("/Sources/" + id + "/edit", function (data) {
            $("#updateSourceForm #up_name").val(data.name);
            $("#updateSourceForm").data("id", data.id); 
            $("#updateSourceModal").modal("show");
        });
    });

    $("#updateSourceForm").on("submit", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/Sources/" + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#updateSourceModal").modal("hide");
                SourcesTable.ajax.reload();
                toastr.success("Source Updated Successfully!");
            },
            error: function (response) {
                if (response.responseJSON && response.responseJSON.errors) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(
                        "An error occurred while updating the Source."
                    );
                }
            },
        });
    });

    $(document).on("click", ".deleteSource", function () {
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
                    url: "/Sources/" + id,
                    success: function (response) {
                        SourcesTable.ajax.reload();
                        toastr.success("Source deleted successfully!");
                    },
                    error: function (response) {
                        toastr.error("Failed to delete Source!");
                    },
                });
            }
        });
    });
});
