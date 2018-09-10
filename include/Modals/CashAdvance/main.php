<!-- The Modal -->
<div class="modal fade" id="cashAdvanceModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="col-md-6 modal-title">Cash Advance</h4>
                <h4 class="col-md-4 modal-title text-right">For JGM</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="cashAdvanceForm">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Date Created</label>
                                        <div class="form-group has-danger">
                                            <input type="date" name="dateCreated" id="dateCreated" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Expense Account</label>
                                        <div class="form-group">
                                            <select name="expenseAccount" class="form-control" required>
                                                <option></option>
                                                <?php
                                                    $stmt = $dbOperation->connect()->query("SELECT * FROM expense_account ORDER BY type");
                                                    while($row = $stmt->fetch()) {
                                                        ?>
                                                    <option value="<?php echo $row->expenseID;?>">
                                                        <?php echo $row->type;?>
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
                                        <label>Section</label>
                                        <div class="form-group">
                                            <select name="section" class="form-control" required>
                                                <option></option>
                                                <?php
                                                    $stmt = $dbOperation->connect()->query("SELECT * FROM section ORDER BY type");
                                                    while($row = $stmt->fetch()) {
                                                        ?>
                                                    <option value="<?php echo $row->sectionID;?>">
                                                        <?php echo $row->type;?>
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
                                        <label>Requestor</label>
                                        <div class="form-group">
                                            <select name="requestor" class="form-control" required>
                                                <option></option>
                                                <?php
                                                    $stmt = $dbOperation->connect()->query("SELECT * FROM users ORDER BY lastName");
                                                    while($row = $stmt->fetch()) {
                                                        ?>
                                                    <option value="<?php echo $row->userID;?>">
                                                        <?php echo $row->lastName . ", " . $row->firstName;?>
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
                                        <label>Cost</label>
                                        <span class="costRequired text-danger"></span>
                                        <div class="form-group">
                                            <input type="number" name="cost" id="cost" class="form-control" value="0.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Purpose</label>
                                        <div class="form-group">
                                            <textarea name="purpose" rows="3" cols="80" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Remarks (Optional)</label>
                                        <div class="form-group">
                                            <textarea name="cashAdvanceRemarks" rows="3" cols="80" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Date Received / Entered</label>
                                        <span class="dateRequired text-danger"></span>
                                        <div class="form-group">
                                            <input type="date" name="dateReceived" id="dateReceived" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Status</label>
                                        <div class="form-group">
                                            <select class="form-control" name="status" required>
                                                <option value="Approved">Approved</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <option value="Disapproved">Disapproved</option>
                                                <option value="For Signature">For Signature</option>
                                                <option value="Processing" selected>Processing</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Date Approved</label>
                                        <span class="dateRequired text-danger"></span>
                                        <div class="form-group">
                                            <input type="date" name="dateApproved" id="dateApproved" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Remarks (Optional)</label>
                                        <div class="form-group">
                                            <textarea name="managerRemarks" rows="3" cols="80" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action">
                        <input type="hidden" name="getIdCashAdvance">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="cashAdvancebtnSubmit" class="btn btn-outline-success btn-block btn-lg">ADD</button>
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