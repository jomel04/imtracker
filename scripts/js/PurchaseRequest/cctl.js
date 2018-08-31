$(document).ready(function () {
    //Fetching Budget Data
    var dataTable = $('#cctl').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/CCTL/PurchaseRequest/fetchData.php",
            method: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true,
        "pagingType": "full_numbers"
    });

    //Clicking Budget Tab
    $('.cctlTab').click(function () {
        dataTable.ajax.reload();
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
                $('button[name="btnSubmitCctl"]').attr("data-dismiss", "modal");
                $("input[name='getIdCctl']").val(id);
                $("input[name='dateReceivedCctl']").val(data.dateReceivedCctl);
                $("select[name='receivedByCctl']").val(data.receivedByCctl);
                $("select[name='statusCctl']").val(data.statusCctl);
                $("textarea[name='remarksCctl']").val(data.remarksCctl);
                $("input[name='dateApprovedCctl']").val(data.dateApprovedCctl);
            },
            error: function () {
                alert("There is an error");
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
                },
                error: function () {
                    alert("There is an error!");
                }
            });
        } else {
            alert("There are still empty fields!");
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
});