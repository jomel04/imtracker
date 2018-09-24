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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NEH | Settings</title>
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
        $activeMenu = 'settings';
        require '../include/header.php';
    ?>
    <div class="container-fluid">
        <div class="row" style="margin-top: 100px;">
            <div class="col-sm-3 col-md-3">
                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">Company</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">Users</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                        aria-controls="v-pills-messages" aria-selected="false">Department</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                        aria-controls="v-pills-settings" aria-selected="false">Section</a>
                </div>
            </div>
            <div class="col-sm-9 col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <button class="btn btn-outline-primary">Add company</button>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="company" class="stripe hover cell-border" style="width:100%">
                                <thead>
                                    <tr class="text-white text-center">
                                        <th colspan="3" style="background-color: #3AAFA9;border-left: 2px solid #3AAFA9;border-right: 2px solid #3AAFA9">
                                            <h3>Company</h3>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="border-left: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">NO.</th>
                                        <th style="border-bottom: 2px solid #3AAFA9">Company name</th>
                                        <th style="border-right: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <button class="btn btn-outline-primary">Add user</button>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="users" class="stripe hover cell-border" style="width:100%">
                                <thead>
                                    <tr class="text-white text-center">
                                        <th colspan="7" style="background-color: #3AAFA9;border-left: 2px solid #3AAFA9;border-right: 2px solid #3AAFA9">
                                            <h3>Users</h3>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="border-left: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">NO.</th>
                                        <th style="border-bottom: 2px solid #3AAFA9">Name</th>
                                        <th style="border-bottom: 2px solid #3AAFA9">Company</th>
                                        <th style="border-bottom: 2px solid #3AAFA9">Department</th>
                                        <th style="border-bottom: 2px solid #3AAFA9">Email</th>
                                        <th style="border-bottom: 2px solid #3AAFA9">Username</th>
                                        <th style="border-right: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <button class="btn btn-outline-primary">Add department</button>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="department" class="stripe hover cell-border" style="width:100%">
                                <thead>
                                    <tr class="text-white text-center">
                                        <th colspan="3" style="background-color: #3AAFA9;border-left: 2px solid #3AAFA9;border-right: 2px solid #3AAFA9">
                                            <h3>Department</h3>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="border-left: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">NO.</th>
                                        <th style="border-bottom: 2px solid #3AAFA9">Department</th>
                                        <th style="border-right: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <button class="btn btn-outline-primary">Add section</button>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="section" class="stripe hover cell-border" style="width:100%">
                                <thead>
                                    <tr class="text-white text-center">
                                        <th colspan="3" style="background-color: #3AAFA9;border-left: 2px solid #3AAFA9;border-right: 2px solid #3AAFA9">
                                            <h3>Section</h3>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="border-left: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">NO.</th>
                                        <th style="border-bottom: 2px solid #3AAFA9">Section</th>
                                        <th style="border-right: 2px solid #3AAFA9;border-bottom: 2px solid #3AAFA9">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../scripts/js/Settings/company.js"></script>
    <script src="../scripts/js/Settings/users.js"></script>
    <script src="../scripts/js/Settings/department.js"></script>
    <script src="../scripts/js/Settings/section.js"></script>
</body>

</html>