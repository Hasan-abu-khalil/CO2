$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var ProductsTable = $("#ProductsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/Products",
        columns: [
            { data: "id", name: "id" },
            { data: "name", name: "name" },
            { data: "unit", name: "unit" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("#addProductForm").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/Products",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                $("#addProductModal").modal("hide");
                $("#addProductForm")[0].reset();
                ProductsTable.ajax.reload();
                toastr.success("Product added successfully");
            },
            error: function (res) {
                if (res.responseJSON && res.responseJSON.errors) {
                    var errors = res.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(
                        " An error occurred while updating the Product"
                    );
                }
            },
        });
    });

    $(document).on("click", ".edit", function () {
        var id = $(this).data("id");
        $.get("/Products/" + id + "/edit", function (data) {
            $("#updateProductForm #up_name").val(data.name);
            $("#updateProductForm #up_unit").val(data.unit);
            $("#updateProductForm").data("id", data.id);
            $("#updateProductModal").modal("show");
        });
    });

    $("#updateProductForm").on("submit", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/Products/" + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#updateProductModal").modal("hide");
                ProductsTable.ajax.reload();
                toastr.success("Product Updated Successfully!");
            },
            error: function (response) {
                if (response.responseJSON && response.responseJSON.errors) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(
                        "An error occurred while updating the Product."
                    );
                }
            },
        });
    });

    $(document).on("click", ".deleteProduct", function () {
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
                    url: "/Products/" + id,
                    success: function (response) {
                        ProductsTable.ajax.reload();
                        toastr.success("Product deleted successfully!");
                    },
                    error: function (response) {
                        toastr.error("Failed to delete Product!");
                    },
                });
            }
        });
    });
});
