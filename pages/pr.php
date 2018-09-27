<?php
    session_start();
    use System\Classes\Database\DatabaseOperation;
    require "../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();
    if(isset($_SESSION['userType']) == 'Admin') {
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
        <title>NEH | Purchase Request</title>
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
            $activeMenu = 'purchaseRequest';
            require '../include/header.php';
            require '../include/Modals/PurchaseRequest/main.php';
            require '../include/Modals/PurchaseRequest/cctl.php';
            require '../include/Modals/PurchaseRequest/budget.php';
            require '../include/Modals/PurchaseRequest/purchasing.php';
            require '../include/Modals/PurchaseRequest/accounting.php';
        ?>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs justify-content-center mt-4">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#purchaseRequestSection">For JGM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cctlTab" data-toggle="tab" href="#cctlSection">For CCTL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link budgetTab" data-toggle="tab" href="#budgetSection">For Budget</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link purchasingTab" data-toggle="tab" href="#purchasingSection">For Purchasing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link accountingTab" data-toggle="tab" href="#accountingSection">For Accounting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link summaryTab" data-toggle="tab" href="#summarySection">Summary</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container-fluid active" id="purchaseRequestSection">
                    <div class="row mt-3">
                        <div class="col-sm-12 text-right">
                            <button type="button" name="btnAdd" id="btnAdd" data-toggle="modal" data-target="#purchaseRequestModal" class="btn btn-outline-primary btn-md">Add new record</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <br>
                        <table id="purchaseRequest" class="stripe hover cell-border" style="width:100%">
                            <thead>
                                <tr class="text-white text-center">
                                    <th colspan="13" style="background-color: #3AAFA9;border-left: 2px solid #3AAFA9;border-right: 2px solid #3AAFA9">
                                        <h3>Innovations Management Purchase Request Tracker</h3>
                                    </th>
                                    <th colspan="7" style="background-color: #FF0080;border-left: 2px solid #FF0080;border-right: 2px solid #FF0080">
                                        <h3>For JGM</h3>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th style="border-left: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">NO.</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Date Created</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Date Entered</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Week no.</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Period no.</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Reference no.</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Expense Account</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Section</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Requestor</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Purpose</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Remarks</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Cost</th>
                                    <th style="border-bottom: 2px solid #3AAFA9">Charge to</th>
                                    <th style="border-left: 2px solid #FF0080;border-bottom: 2px solid #FF0080">Date Received (Entered)</th>
                                    <th style="border-bottom: 2px solid #FF0080">Status</th>
                                    <th style="border-bottom: 2px solid #FF0080">Date Approved</th>
                                    <th style="border-bottom: 2px solid #FF0080">Remarks</th>
                                    <th style="border-bottom: 2px solid #FF0080">No. of Days</th>
                                    <th style="border-right: 2px solid #FF0080;border-bottom: 2px solid #FF0080">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container-fluid fade" id="cctlSection">
                    <div class="table-responsive">
                        <br>
                        <table id="cctl" class="stripe hover cell-border" style="width:100%">
                            <thead>
                                <tr class="text-center text-light">
                                    <th style="background-color: #3AAFA9">NO</th>
                                    <th style="background-color: #3AAFA9">Reference no.</th>
                                    <th style="background-color: #3AAFA9">Requestor</th>
                                    <th style="background-color: #3AAFA9">Expense Account</th>
                                    <th style="background-color: #3AAFA9">Section</th>
                                    <th style="background-color: #3AAFA9">Purpose</th>
                                    <th style="background-color: #3AAFA9">Remarks</th>
                                    <th style="background-color: #3AAFA9">Cost</th>
                                    <th style="background-color: #3AAFA9">Charge to</th>
                                    <th style="background-color: #FF0080">Date Received (Entered)</th>
                                    <th style="background-color: #FF0080">Received by</th>
                                    <th style="background-color: #FF0080">Status</th>
                                    <th style="background-color: #FF0080">Remarks</th>
                                    <th style="background-color: #FF0080">Date Approved</th>
                                    <th style="background-color: #FF0080">Lead time (Days)</th>
                                    <th style="background-color: #FF0080">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container-fluid fade" id="budgetSection">
                    <div class="table-responsive">
                        <br>
                        <table id="budget" class="stripe hover cell-border" style="width:100%">
                            <thead>
                                <tr class="text-center text-light">
                                    <th style="background-color: #3AAFA9">NO</th>
                                    <th style="background-color: #3AAFA9">Reference no.</th>
                                    <th style="background-color: #3AAFA9">Requestor</th>
                                    <th style="background-color: #3AAFA9">Expense Account</th>
                                    <th style="background-color: #3AAFA9">Section</th>
                                    <th style="background-color: #3AAFA9">Purpose</th>
                                    <th style="background-color: #3AAFA9">Remarks</th>
                                    <th style="background-color: #3AAFA9">Cost</th>
                                    <th style="background-color: #3AAFA9">Charge to</th>
                                    <th style="background-color: #FF0080">Budgeted</th>
                                    <th style="background-color: #FF0080">Date Received (Entered)</th>
                                    <th style="background-color: #FF0080">Received by</th>
                                    <th style="background-color: #FF0080">Status</th>
                                    <th style="background-color: #FF0080">Remarks</th>
                                    <th style="background-color: #FF0080">Date Approved</th>
                                    <th style="background-color: #FF0080">Lead time (Days)</th>
                                    <th style="background-color: #FF0080">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container-fluid fade" id="purchasingSection">
                    <div class="table-responsive">
                        <br>
                        <table id="purchasing" class="stripe hover cell-border" style="width:100%">
                            <thead>
                                <tr class="text-center text-light">
                                    <th style="background-color: #3AAFA9">NO</th>
                                    <th style="background-color: #3AAFA9">Reference no.</th>
                                    <th style="background-color: #3AAFA9">Requestor</th>
                                    <th style="background-color: #3AAFA9">Expense Account</th>
                                    <th style="background-color: #3AAFA9">Section</th>
                                    <th style="background-color: #3AAFA9">Purpose</th>
                                    <th style="background-color: #3AAFA9">Remarks</th>
                                    <th style="background-color: #3AAFA9">Cost</th>
                                    <th style="background-color: #3AAFA9">Charge to</th>
                                    <th style="background-color: #FF0080">Date Received (Entered)</th>
                                    <th style="background-color: #FF0080">Received by</th>
                                    <th style="background-color: #FF0080">Status</th>
                                    <th style="background-color: #FF0080">PO no.</th>
                                    <th style="background-color: #FF0080">Remarks</th>
                                    <th style="background-color: #FF0080">Release Date</th>
                                    <th style="background-color: #FF0080">Lead time (Days)</th>
                                    <th style="background-color: #FF0080">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container-fluid fade" id="accountingSection">
                    <div class="table-responsive">
                        <br>
                        <table id="accounting" class="stripe hover cell-border" style="width:100%">
                            <thead>
                                <tr class="text-center text-light">
                                    <th style="background-color: #3AAFA9">NO</th>
                                    <th style="background-color: #3AAFA9">Reference no.</th>
                                    <th style="background-color: #3AAFA9">Requestor</th>
                                    <th style="background-color: #3AAFA9">Expense Account</th>
                                    <th style="background-color: #3AAFA9">Section</th>
                                    <th style="background-color: #3AAFA9">Purpose</th>
                                    <th style="background-color: #3AAFA9">Remarks</th>
                                    <th style="background-color: #3AAFA9">Cost</th>
                                    <th style="background-color: #3AAFA9">Charge to</th>
                                    <th style="background-color: #FF0080">Date Received (Entered)</th>
                                    <th style="background-color: #FF0080">Received by</th>
                                    <th style="background-color: #FF0080">Status</th>
                                    <th style="background-color: #FF0080">Remarks</th>
                                    <th style="background-color: #FF0080">Release Date</th>
                                    <th style="background-color: #FF0080">Lead time (Days)</th>
                                    <th style="background-color: #FF0080">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container-fluid fade" id="summarySection">
                    <div class="table-responsive">
                        <br>
                        <table id="summary" class="stripe hover cell-border" style="width:100%">
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
            <script src="../scripts/js/PurchaseRequest/purchaseRequest.js"></script>
            <script src="../scripts/js/PurchaseRequest/cctl.js"></script>
            <script src="../scripts/js/PurchaseRequest/budget.js"></script>
            <script src="../scripts/js/PurchaseRequest/purchasing.js"></script>
            <script src="../scripts/js/PurchaseRequest/accounting.js"></script>
            <script src="../scripts/js/PurchaseRequest/summary.js"></script>
    </body>

    </html>