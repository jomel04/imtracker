<?php
    session_start();
    use System\Classes\Database\DatabaseOperation;
    require "../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();
    if(isset($_SESSION['userType']) == 'User') {
    	$user = $_SESSION['user'];
    } else {
        echo "<script>location.assign('../index.php');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NEH | Cash Advance</title>
    <!-- ICON -->
    <link rel="icon" href="../resources/images/NEH.png">
    <link rel="stylesheet" type="text/css" href="../resources/icons/font/css/open-iconic-bootstrap.css">
    <!-- JQUERY -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <!-- BOOTSTRAP CSS-->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- BOOTSTRAP JS -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DATATABLES -->
    <script src="../resources/datatables/datatables.min.js"></script>
    <script src="../resources/datatables/dist/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="../resources/datatables/datatables.min.css">
    <link rel="stylesheet" href="../resources/datatables/dist/css/dataTables.bootstrap4.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../resources/css/style.css">
</head>

<body>
    <?php
        require '../include/header.php';
    ?>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs justify-content-center mt-4">
        <li class="nav-item">
            <a class="nav-link active cashAdvanceTab" data-toggle="tab" href="#cashAdvanceSection">Cash Advance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link requestForPaymentTab" data-toggle="tab" href="#requestForPaymentSection">Request for
                Payment</a>
        </li>
        <li class="nav-item">
            <a class="nav-link purchaseRequestTab" data-toggle="tab" href="#purchaseRequestSection">Purchase Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link jobServiceRequestTab" data-toggle="tab" href="#jobServiceRequestSection">Job Service
                Request</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane container-fluid active" id="cashAdvanceSection">
            <div class="table-responsive">
                <br>
                <table id="cashAdvance" class="stripe hover cell-border" style="width:100%">
                    <thead>
                        <tr class="text-center text-light">
                            <th style="background-color: #3AAFA9">Date Created</th>
                            <th style="background-color: #3AAFA9">Date Entered</th>
                            <th style="background-color: #3AAFA9">Week no.</th>
                            <th style="background-color: #3AAFA9">Period no.</th>
                            <th style="background-color: #3AAFA9">Status</th>
                            <th style="background-color: #3AAFA9">Expense Account</th>
                            <th style="background-color: #3AAFA9">Section</th>
                            <th style="background-color: #3AAFA9">Requestor</th>
                            <th style="background-color: #3AAFA9">Purpose</th>
                            <th style="background-color: #3AAFA9">Remarks</th>
                            <th style="background-color: #3AAFA9">Cost</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane container-fluid fade" id="requestForPaymentSection">
            <div class="table-responsive">
                <br>
                <table id="requestForPayment" class="stripe hover cell-border" style="width:100%">
                    <thead>
                        <tr class="text-center text-light">
                            <th style="background-color: #3AAFA9">Date Created</th>
                            <th style="background-color: #3AAFA9">Date Entered</th>
                            <th style="background-color: #3AAFA9">Week no.</th>
                            <th style="background-color: #3AAFA9">Period no.</th>
                            <th style="background-color: #3AAFA9">Status</th>
                            <th style="background-color: #3AAFA9">Expense Account</th>
                            <th style="background-color: #3AAFA9">Section</th>
                            <th style="background-color: #3AAFA9">Requestor</th>
                            <th style="background-color: #3AAFA9">Payee</th>
                            <th style="background-color: #3AAFA9">Purpose</th>
                            <th style="background-color: #3AAFA9">Remarks</th>
                            <th style="background-color: #3AAFA9">Cost</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane container-fluid fade" id="purchaseRequestSection">
            <div class="table-responsive">
                <br>
                <table id="purchaseRequest" class="stripe hover cell-border" style="width:100%">
                    <thead>
                        <tr class="text-center text-light">
                            <th style="background-color: #3AAFA9">Date Created</th>
                            <th style="background-color: #3AAFA9">Date Entered</th>
                            <th style="background-color: #3AAFA9">Week no.</th>
                            <th style="background-color: #3AAFA9">Period no.</th>
                            <th style="background-color: #3AAFA9">Reference no.</th>
                            <th style="background-color: #3AAFA9">Status</th>
                            <th style="background-color: #3AAFA9">Expense Account</th>
                            <th style="background-color: #3AAFA9">Section</th>
                            <th style="background-color: #3AAFA9">Requestor</th>
                            <th style="background-color: #3AAFA9">Purpose</th>
                            <th style="background-color: #3AAFA9">Remarks</th>
                            <th style="background-color: #3AAFA9">Cost</th>
                            <th style="background-color: #3AAFA9">Charge to</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane container-fluid fade" id="jobServiceRequestSection">
            <div class="table-responsive">
                <br>
                <table id="jobServiceRequest" class="stripe hover cell-border" style="width:100%">
                    <thead>
                        <tr class="text-center text-light">
                            <th style="background-color: #3AAFA9">Date Created</th>
                            <th style="background-color: #3AAFA9">Date Entered</th>
                            <th style="background-color: #3AAFA9">Week no.</th>
                            <th style="background-color: #3AAFA9">Period no.</th>
                            <th style="background-color: #3AAFA9">Reference no.</th>
                            <th style="background-color: #3AAFA9">Status</th>
                            <th style="background-color: #3AAFA9">Expense Account</th>
                            <th style="background-color: #3AAFA9">Section</th>
                            <th style="background-color: #3AAFA9">Requestor</th>
                            <th style="background-color: #3AAFA9">Purpose</th>
                            <th style="background-color: #3AAFA9">Remarks</th>
                            <th style="background-color: #3AAFA9">Cost</th>
                            <th style="background-color: #3AAFA9">Charge to</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script src="../scripts/js/UserView/CashAdvance.js"></script>
    <script src="../scripts/js/UserView/RequestForPayment.js"></script>
    <script src="../scripts/js/UserView/PurchaseRequest.js"></script>
    <script src="../scripts/js/UserView/JobServiceRequest.js"></script>
</body>

</html>