<!-- The Modal -->
<div class="modal fade" id="departmentModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="col-md-4 offset-md-4 modal-title text-center">DEPARTMENT</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="departmentForm">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Department:</label>
                                    <input type="text" name="departmentName" class="form-control" placeholder="Enter department name"
                                        required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action">
                        <input type="hidden" name="getDepartmentId">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="departmentBtnSubmit" class="btn btn-outline-success btn-block btn-lg">ADD</button>
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