$(document).ready(function () {
    //Fetching Budget Data
    var dataTable = $('#cctl').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/CCTL/PurchaseRequest/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Clicking budget tab & reloading ajax
    $('.cctlTab').click(function () {
        dataTable.ajax.reload();
    });

    //For Selecting Status
    $('select[name="statusCctl"]').change(function () {
        if (this.value != "Approved") {
            $("input[name='dateReceivedCctl']").removeAttr("disabled");
            $("select[name='receivedByCctl']").removeAttr("disabled");
            $("input[name='dateApprovedCctl']").prop("disabled", true);
            $('span.dateCctl').text('');
        } else {
            $("input[name='dateReceivedCctl']").removeAttr("disabled");
            $("select[name='receivedByCctl']").removeAttr("disabled");
            $("input[name='dateApprovedCctl']").removeAttr("disabled").focus();
            $('button[name="btnSubmitCctl"]').removeAttr("data-dismiss").attr('disabled', true);
            $('span.dateCctl').text('(Please fill out this field)');
        }
    });
    $("input[name='dateReceivedCctl'], select[name='receivedByCctl'], input[name='dateApprovedCctl']").change(function () {
        if ($("input[name='dateReceivedCctl']").val() != "" && $("select[name='statusCctl']").val() != "" && $("select[name='receivedByCctl']").val() != "" || $("input[name='dateApprovedCctl']").val() != "") {
            $('span.dateCctl').text('');
            $('button[name="btnSubmitCctl"]').attr("data-dismiss", "modal").removeAttr('disabled');
        } else {
            $('button[name="btnSubmitCctl"]').removeAttr("data-dismiss").attr('disabled', true);
        }
    });

    //Selecting Data Budget Data
    $(document).on('click', 'button[name="btnUpdateCctl"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '../scripts/php/CCTL/PurchaseRequest/selectData.php',
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $('#cctlModal').modal('show');
                $("input[name='getIdCctl']").val(id);
                $("input[name='dateReceivedCctl']").val(data.dateReceivedCctl).prop("disabled", true);
                $("select[name='receivedByCctl']").val(data.receivedByCctl).prop("disabled", true);
                $("select[name='statusCctl']").val(data.statusCctl);
                $("textarea[name='remarksCctl']").val(data.remarksCctl);
                $("input[name='dateApprovedCctl']").val(data.dateApprovedCctl).prop("disabled", true);
                if (data.statusCctl != "") {
                    $('button[name="btnSubmitCctl"]').attr("data-dismiss", "modal");
                }
            }
        });
    });

    //Submitting Accounting Data
    $(document).on('click', 'button[name="btnSubmitCctl"]', function () {
        var id = $('input[name="getIdCctl"]').val();
        var dateReceivedCctl = $('input[name="dateReceivedCctl"]').val();
        var receivedByCctl = $('select[name="receivedByCctl"]').val();
        var statusCctl = $('select[name="statusCctl"]').val();
        var remarksCctl = $('textarea[name="remarksCctl"]').val();
        var dateApprovedCctl = $('input[name="dateApprovedCctl"]').val();
        if (dateReceivedCctl != "" && receivedByCctl != "" && statusCctl != "" && dateApprovedCctl != "") {
            $.ajax({
                url: "../scripts/php/CCTL/PurchaseRequest/updateData.php",
                method: "POST",
                data: {
                    id: id,
                    dateReceivedCctl: dateReceivedCctl,
                    receivedByCctl: receivedByCctl,
                    statusCctl: statusCctl,
                    remarksCctl: remarksCctl,
                    dateApprovedCctl: dateApprovedCctl
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                    $('button[name="btnSubmitCctl"]').removeAttr("data-dismiss");
                }
            });
        } else if (dateReceivedCctl != "" && receivedByCctl != "" && statusCctl != "") {
            $.ajax({
                url: "../scripts/php/CCTL/PurchaseRequest/updateData.php",
                method: "POST",
                data: {
                    id: id,
                    dateReceivedCctl: dateReceivedCctl,
                    receivedByCctl: receivedByCctl,
                    statusCctl: statusCctl,
                    remarksCctl: remarksCctl,
                    dateApprovedCctl: dateApprovedCctl
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                    $('button[name="btnSubmitCctl"]').removeAttr("data-dismiss");
                }
            });
        }
    });

    // For Delete
    $(document).on("click", "button[name='btnDeleteCctl']", function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to remove this data?')) {
            $.ajax({
                url: "../scripts/php/CCTL/PurchaseRequest/deleteData.php",
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

    //For skipping transaction
    $(document).on('click', '#btnSkip', function () {
        var id = $('input[name="getIdCctl"').val();
        if (confirm('Are you sure you want to skip it?')) {
            $.ajax({
                url: "../scripts/php/CCTL/PurchaseRequest/skip.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function (data) {
                    $('#cctlModal').modal('hide');
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });
});