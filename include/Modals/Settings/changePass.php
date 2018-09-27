<!-- The Modal -->
<div class="modal fade" id="changePassModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="col-md-4 offset-md-4 modal-title text-center">PROFILE</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="changePassForm" action="../scripts/php/UserView/ChangePass/updateData.php">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <h5 class="text-dark text-center">Change password</h5>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Current Password:</label>
                                    <input type="password" name="currentPassword" class="form-control" placeholder="Enter your Current Password"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>New Password:</label>
                                    <input type="password" name="newPassword" class="form-control" placeholder="Enter your New Password"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Confirm Password:</label>
                                    <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm your Password"
                                        required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="getUserId">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" name="changePassBtnUpdate" class="btn btn-outline-success btn-block btn-lg">UPDATE</button>
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