<!-- The Modal -->
<div class="modal fade" id="expenseAccountModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="col-md-4 offset-md-4 modal-title text-center">EXPENSE ACCOUNT</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="expenseAccountForm">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Expense account:</label>
                                    <input type="text" name="expenseAccount" class="form-control" placeholder="Enter expense account type"
                                        required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action">
                        <input type="hidden" name="getExpenseAccountId">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="expenseAccountBtnSubmit" class="btn btn-outline-success btn-block btn-lg">ADD</button>
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