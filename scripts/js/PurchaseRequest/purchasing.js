$(document).ready(function () {
    //Fetching Purchasing Data
    var dataTable = $('#purchasing').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Purchasing/PurchaseRequest/fetchData.php",
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

    //For Selecting Status
    $('select[name="statusPurchasing"]').change(function () {
        if (this.value == "") {
            $("input[name='dateReceivedPurchasing']").attr('disabled', true);
            $("select[name='receivedByPurchasing']").attr('disabled', true);
            $("input[name='poNoPurchasing']").attr('disabled', true);
            $("input[name='releaseDatePurchasing']").attr('disabled', true);
            $('span.requiredPurchasing').text('');
        } else {
            $("input[name='dateReceivedPurchasing']").removeAttr('disabled');
            $("select[name='receivedByPurchasing']").removeAttr('disabled');
            $("input[name='poNoPurchasing']").removeAttr('disabled');
            $("input[name='releaseDatePurchasing']").removeAttr('disabled');
            $('span.requiredPurchasing').text('(Please fill out this field)');
        }
    });
    $("input[name='dateReceivedPurchasing'], select[name='receivedByPurchasing'], input[name='poNoPurchasing'], input[name='releaseDatePurchasing']").change(function () {
        if ($("input[name='dateReceivedPurchasing']").val() != "" && $("select[name='receivedByPurchasing']").val() != "" && $("input[name='poNoPurchasing']").val() != "" && $("input[name='releaseDatePurchasing']").val() != "") {
            $('span.requiredPurchasing').text('');
            $('button[name="btnSubmitPurchasing"]').attr("data-dismiss", "modal");
        } else {
            $('button[name="btnSubmitPurchasing"]').removeAttr("data-dismiss");
        }
    });

    //Selecting Purchasing Data
    $(document).on('click', 'button[name="btnUpdatePurchasing"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '../scripts/php/Purchasing/PurchaseRequest/selectData.php',
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $('#purchasingModal').modal('show');
                $("input[name='getIdPurchasing']").val(id);
                $("input[name='dateReceivedPurchasing']").val(data.dateReceivedPurchasing).prop("disabled", true);
                $("select[name='receivedByPurchasing']").val(data.receivedByPurchasing).prop("disabled", true);
                $("select[name='statusPurchasing']").val(data.statusPurchasing);
                $("input[name='poNoPurchasing']").val(data.poNoPurchasing).prop("disabled", true);
                $("textarea[name='remarksPurchasing']").val(data.remarksPurchasing);
                $("input[name='releaseDatePurchasing']").val(data.releaseDatePurchasing).prop("disabled", true);
                if (data.statusPurchasing != "") {
                    $('button[name="btnSubmitPurchasing"]').attr("data-dismiss", "modal");
                }
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
        if (dateReceivedPurchasing != "" && receivedByPurchasing != "" && statusPurchasing != "" && poNoPurchasing != "" && releaseDatePurchasing != "") {
            $.ajax({
                url: "../scripts/php/Purchasing/PurchaseRequest/updateData.php",
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
                }
            });
        }
    });

    // // For Delete
    $(document).on("click", "button[name='btnDeletePurchasing']", function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to remove this data?')) {
            $.ajax({
                url: "../scripts/php/Purchasing/PurchaseRequest/deleteData.php",
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