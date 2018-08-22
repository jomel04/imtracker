<!-- The Modal -->
<div class="modal fade" id="accountingModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h4 class="col-sm-4 offset-sm-4 col-md-4 offset-md-4">Accounting</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="accountingModal">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="dateReceivedAccounting">Date Received</label>
                                    <input type="date" name="dateReceivedAccounting" id="dateReceivedAccounting" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="receivedByAccounting">Received By</label>
                                    <select name="receivedByAccounting" id="receivedByAccounting" class="form-control" required>
                                        <option value=""></option>
                                        <option value="Person 1">Person 1</option>
                                        <option value="Person 2">Person 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="statusAccounting">Status</label>
                                    <select name="statusAccounting" id="statusAccounting" class="form-control" required>
                                        <option value=""></option>
                                        <option value="Processing">Processing</option>
                                        <option value="Released">Released</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="releaseDateAccounting">Release Date</label>
                                    <input type="date" name="releaseDateAccounting" id="releaseDateAccounting" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <label for="remarksAccounting">Remarks</label>
                                <div class="form-group">
                                    <textarea name="remarksAccounting" id="remarksAccounting" rows="3" cols="80" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="getIdAccounting">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="btnSubmitAccounting" id="btnSubmitAccounting" class="btn btn-outline-success btn-block btn-lg">SUBMIT</button>
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