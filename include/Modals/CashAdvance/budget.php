<!-- The Modal -->
<div class="modal fade" id="budgetModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h4 class="col-sm-4 offset-sm-4 col-md-4 offset-md-4">Budget</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="budgetForm">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="budgeted">Budgeted</label>
                                    <select name="budgeted" id="budgeted" class="form-control" required>
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="dateReceivedBudget">Date Received / Entered</label>
                                    <input type="date" name="dateReceivedBudget" id="dateReceivedBudget" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="dateApprovedBudget">Date Approved</label>
                                    <span class="requiredField text-danger"></span>
                                    <input type="date" name="dateApprovedBudget" id="dateApprovedBudget" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="statusBudget">Status</label>
                                    <select name="statusBudget" id="statusBudget" class="form-control" required>
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
                                    <label for="receivedByBudget">Received By</label>
                                    <span class="requiredField text-danger"></span>
                                    <select name="receivedByBudget" id="receivedByBudget" class="form-control" required>
                                        <option value=""></option>
                                        <option value="Edwin Chua">Edwin Chua</option>
                                        <option value="Eheginia Bantilan">Eheginia Bantilan</option>
                                        <option value="Dannica Ngojo">Dannica Ngojo</option>
                                        <option value="Jeroen de Haas">Jeroen de Haas</option>
                                        <option value="Karla Briones">Karla Briones</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <label for="remarksBudget">Remarks (Optional)</label>
                                <div class="form-group">
                                    <textarea name="remarksBudget" id="remarksBudget" rows="3" cols="80" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="getIdBudget">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="btnSubmitBudget" id="btnSubmitBudget" class="btn btn-outline-success btn-block btn-lg">SUBMIT</button>
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