<!-- The Modal -->
<div class="modal fade" id="jobServiceRequestModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="col-md-6 modal-title">Job Service Request</h4>
                <h4 class="col-md-4 modal-title text-right">For JGM</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="jobServiceRequestForm">
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
                                        <label>Referece no.</label>
                                        <div class="form-group has-danger">
                                            <input type="number" name="refNo" id="refNo" class="form-control" required>
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
                                        <label>Charge to</label>
                                        <div class="form-group">
                                            <select name="chargeTo" class="form-control" required>
                                                <option></option>
                                                <option value="DANA FDN">DANA FDN</option>
                                                <option value="DFADI">DFADI</option>
                                                <option value="DFAI">DFAI</option>
                                                <option value="DFFC">DFFC</option>
                                                <option value="NEH">NEH</option>
                                                <option value="NEH - FMI">NEH - FMI</option>
                                                <option value="NEH - IM">NEH - IM</option>
                                                <option value="RPBH">RPBH</option>
                                                <option value="DEL MON">DEL MON</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Cost</label>
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
                                            <textarea name="jobServiceRequestRemarks" rows="3" cols="80" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Date Received / Entered</label>
                                        <div class="form-group">
                                            <input type="date" name="dateReceived" id="dateReceived" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Status</label>
                                        <div class="form-group">
                                            <select class="form-control" name="status" required>
                                                <option></option>
                                                <option value="Approved">Approved</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <option value="Disapproved">Disapproved</option>
                                                <option value="For Signature">For Signature</option>
                                                <option value="Processing">Processing</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label>Date Approved</label>
                                        <div class="form-group">
                                            <input type="date" name="dateApproved" id="dateApproved" class="form-control" required>
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
                        <input type="hidden" name="getIdJobServiceRequest">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="jobServiceRequestbtnSubmit" id="jobServiceRequestbtnSubmit" class="btn btn-outline-success btn-block btn-lg">ADD</button>
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