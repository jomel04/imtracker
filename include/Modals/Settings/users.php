<!-- The Modal -->
<div class="modal fade" id="usersModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="col-md-4 offset-md-4 modal-title text-center">USERS</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="usersForm">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>First name:</label>
                                    <input type="text" name="firstName" class="form-control" placeholder="Enter First name"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Last name:</label>
                                    <input type="text" name="lastName" class="form-control" placeholder="Enter Last name"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Company:</label>
                                    <select name="company" class="form-control">
                                        <option value=""></option>
                                        <?php
                                            $stmt = $dbOperation->connect()->query("SELECT companyID, name FROM company ORDER BY name");
                                            while($row = $stmt->fetch()) {
                                                ?>
                                        <option value="<?php echo $row->companyID;?>">
                                            <?php echo $row->name;?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Department:</label>
                                    <select name="department" class="form-control">
                                        <option value=""></option>
                                        <?php
                                            $stmt = $dbOperation->connect()->query("SELECT departmentID, name FROM department ORDER BY name");
                                            while($row = $stmt->fetch()) {
                                                ?>
                                        <option value="<?php echo $row->departmentID;?>">
                                            <?php echo $row->name;?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Role:</label>
                                    <select name="role" class="form-control">
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                        <option value="Manager">Manager</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Username:</label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter Username"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Confirm Password:</label>
                                    <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password"
                                        required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action">
                        <input type="hidden" name="getUserId">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" name="usersBtnSubmit" class="btn btn-outline-success btn-block btn-lg">ADD</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnClose" class="btn btn-outline-danger btn-lg" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>