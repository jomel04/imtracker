<!-- The Modal -->
<div class="modal fade" id="cctlModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h4 class="col-sm-4 offset-sm-4 col-md-4 offset-md-4">CCTL</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="cctlForm">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="dateReceivedCctl">Date Received / Entered</label>
                                    <input type="date" name="dateReceivedCctl" id="dateReceivedCctl" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="dateApprovedCctl">Date Approved</label>
                                    <span class="dateCctl text-danger"></span>
                                    <input type="date" name="dateApprovedCctl" id="dateApprovedCctl" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="statusCctl">Status</label>
                                    <select name="statusCctl" id="statusCctl" class="form-control" required>
                                        <option value="Approved">Approved</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Disapproved">Disapproved</option>
                                        <option value="For Signature">For Signature</option>
                                        <option value="Processing">Processing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="receivedByCctl">Received By</label>
                                    <select name="receivedByCctl" id="receivedByCctl" class="form-control" required>
                                        <option value=""></option>
                                        <option value="Mark Pulido">Mark Pulido</option>
                                        <option value="Danica Bendigo">Danica Bendigo</option>
                                        <option value="Chenelly Doromal">Chenelly Doromal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <label for="remarksCctl">Remarks (Optional)</label>
                                <div class="form-group">
                                    <textarea name="remarksCctl" id="remarksCctl" rows="3" cols="80" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="getIdCctl">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="btnSubmitCctl" id="btnSubmitCctl" class="btn btn-outline-success btn-block btn-lg">SUBMIT</button>
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