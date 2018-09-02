$(document).ready(function () {
    //Fetching Purchasing Data
    var dataTable = $('#purchasing').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Purchasing/JobServiceRequest/fetchData.php",
            method: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true,
        "pagingType": "full_numbers"
    });

    //Clicking Purchasing Tab
    $('.purchasingTab').click(function () {
        dataTable.ajax.reload();
    });

    //Selecting Purchasing Data
    $(document).on('click', 'button[name="btnUpdatePurchasing"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '../scripts/php/Purchasing/JobServiceRequest/selectData.php',
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $('#purchasingModal').modal('show');
                $('button[name="btnSubmitPurchasing"]').attr("data-dismiss", "modal");
                $("input[name='getIdPurchasing']").val(id);
                $("input[name='dateReceivedPurchasing']").val(data.dateReceivedPurchasing);
                $("select[name='receivedByPurchasing']").val(data.receivedByPurchasing);
                $("select[name='statusPurchasing']").val(data.statusPurchasing);
                $("input[name='poNoPurchasing']").val(data.poNoPurchasing);
                $("textarea[name='remarksPurchasing']").val(data.remarksPurchasing);
                $("input[name='releaseDatePurchasing']").val(data.releaseDatePurchasing);
            },
            error: function () {
                alert("There is an error");
            }
        });
    });

    //Submitting Purchasing Data
    $(document).on('click', 'button[name="btnSubmitPurchasing"]', function () {
        var id = $('input[name="getIdPurchasing"]').val();
        var dateReceivedPurchasing = $('input[name="dateReceivedPurchasing"]').val();
        var receivedByPurchasing = $('select[name="receivedByPurchasing"]').val();
        var statusPurchasing = $('select[name="statusPurchasing"]').val();
        var poNoPurchasing = $('input[name="poNoPurchasing"]').val();
        var remarksPurchasing = $('textarea[name="remarksPurchasing"]').val();
        var releaseDatePurchasing = $('input[name="releaseDatePurchasing"]').val();
        if (dateReceivedPurchasing != "" && receivedByPurchasing != "" && statusPurchasing != "" && poNoPurchasing != "") {
            $.ajax({
                url: "../scripts/php/Purchasing/JobServiceRequest/updateData.php",
                method: "POST",
                data: {
                    id: id,
                    dateReceivedPurchasing: dateReceivedPurchasing,
                    receivedByPurchasing: receivedByPurchasing,
                    statusPurchasing: statusPurchasing,
                    poNoPurchasing: poNoPurchasing,
                    remarksPurchasing: remarksPurchasing,
                    releaseDatePurchasing: releaseDatePurchasing
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                },
                error: function () {
                    alert("There is an error!");
                }
            });
        } else {
            alert("There are still empty fields!");
        }
    });

    // // For Delete
    $(document).on("click", "button[name='btnDeletePurchasing']", function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to remove this data?')) {
            $.ajax({
                url: "../scripts/php/Purchasing/JobServiceRequest/deleteData.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });
});