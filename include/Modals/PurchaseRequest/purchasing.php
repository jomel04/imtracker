<!-- The Modal -->
<div class="modal fade" id="purchasingModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h4 class="col-sm-4 offset-sm-4 col-md-4 offset-md-4">Purchasing</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="purchasingModal">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="dateReceivedPurchasing">Date Received / Entered</label>
                                    <input type="date" name="dateReceivedPurchasing" id="dateReceivedPurchasing" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="receivedByPurchasing">Received By</label>
                                    <select name="receivedByPurchasing" id="receivedByPurchasing" class="form-control"
                                        required>
                                        <option value=""></option>
                                        <option value="Person 1">Person 1</option>
                                        <option value="Person 2">Person 2</option>
                                        <option value="Person 3">Person 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="statusPurchasing">Status</label>
                                    <select name="statusPurchasing" id="statusPurchasing" class="form-control" required>
                                        <option value=""></option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Installed">Installed</option>
                                        <option value="Ordered">Ordered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="poNoPurchasing">PO no.</label>
                                    <input type="number" name="poNoPurchasing" id="poNoPurchasing" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="releaseDatePurchasing">Release Date</label>
                                    <input type="date" name="releaseDatePurchasing" id="releaseDatePurchasing" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <label for="remarksPurchasing">Remarks (Optional)</label>
                                <div class="form-group">
                                    <textarea name="remarksPurchasing" id="remarksPurchasing" rows="3" cols="80" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="getIdPurchasing">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="btnSubmitPurchasing" id="btnSubmitPurchasing" class="btn btn-outline-success btn-block btn-lg">SUBMIT</button>
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