$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var Co2Table = $("#Co2Table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/Co2",
        columns: [
            { data: "id", name: "id" },
            { data: "product_name", name: "product_name" },
            { data: "unit", name: "unit" },
            { data: "percentage_amount", name: "percentage_amount" },
            { data: "amount", name: "amount" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],

        // // Trigger the chart update on data load
        // drawCallback: function (settings) {
        //     // Update the chart with the latest data from DataTable
        //     updateChart(Co2Table.ajax.json().data);
        // },
    });

    // function updateChart(data) {
    //     var labels = data.map((item) => item.product_name);
    //     var amounts = data.map((item) => item.amount);

    //     var ctx = document.getElementById("co2Chart").getContext("2d");
    //     var co2Chart = new Chart(ctx, {
    //         type: "bar",
    //         data: {
    //             labels: labels,
    //             datasets: [
    //                 {
    //                     label: "CO2 Emissions by Product",
    //                     data: amounts,
    //                     backgroundColor: "rgba(54, 162, 235, 0.6)",
    //                     borderColor: "rgba(54, 162, 235, 1)",
    //                     borderWidth: 1,
    //                 },
    //             ],
    //         },
    //         options: {
    //             scales: {
    //                 y: {
    //                     beginAtZero: true,
    //                 },
    //             },
    //         },
    //     });
    // }

    $("#addCo2Form").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/Co2",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                $("#addCo2Modal").modal("hide");
                $("#addCo2Form")[0].reset();
                Co2Table.ajax.reload();
                toastr.success("Co2 added successfully");
            },
            error: function (res) {
                if (res.responseJSON && res.responseJSON.errors) {
                    var errors = res.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error(" An error occurred while updating the Co2");
                }
            },
        });
    });

    $(document).on("click", ".edit", function () {
        var id = $(this).data("id");
        $.get("/Co2/" + id + "/edit", function (data) {
            $("#updateCo2Form #up_amount").val(data.amount);
            $("#updateCo2Form #up_unit").val(data.unit);
            $("#updateCo2Form #up_percentage_id").val(data.percentage_id);
            $("#updateCo2Form #up_product_id").val(data.product_id);
            $("#updateCo2Form").data("id", data.id);
            $("#updateCo2Modal").modal("show");
        });
    });

    $("#updateCo2Form").on("submit", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/Co2/" + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#updateCo2Modal").modal("hide");
                Co2Table.ajax.reload();
                toastr.success("Co2 Updated Successfully!");
            },
            error: function (response) {
                if (response.responseJSON && response.responseJSON.errors) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error("An error occurred while updating theCo2.");
                }
            },
        });
    });

    $(document).on("click", ".deleteCo2", function () {
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
                    url: "/Co2/" + id,
                    success: function (response) {
                        Co2Table.ajax.reload();
                        toastr.success("Co2 deleted successfully!");
                    },
                    error: function (response) {
                        toastr.error("Failed to delete Co2!");
                    },
                });
            }
        });
    });
});
