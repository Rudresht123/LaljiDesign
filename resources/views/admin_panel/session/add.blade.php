<form action="{{ route('admin.global-setting.financialYear') }}" method="POST">
    @csrf
    <fieldset class="form-fieldset  mx-3 mb-3">
        <legend>Financial Year Information</legend>
        <div class="gorm-group ">
            <label for="" class="form-label">Financial Year <span
                    class="text-danger">*</span></label>
            <input type="text" name="financial_session" autocomplete="off" class="form-control input-sm"
                required placeholder="Enter Financial Year Like : 2019-2020">
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="" class="form-label">Start Date <span
                        class="text-danger">*</span></label>
                <input type="date" name="start_date" autocomplete="off" class="date form-control input-sm"
                    required placeholder="Enter Satrt Date like : dd-mm-yyyy ">
            </div>
            <div class="col-sm-6 form-group">
                <label for="" class="form-label">End Date<span class="text-danger">*</span></label>
                <input type="date" name="end_date" required autocomplete="off"
                    class="form-control date input-sm hasDatepicker"
                    placeholder="Enter End Date (dd-mm-yyyy)">
            </div>
            <div class="mb-3">
                <b>Default Active : </b> <input type="checkbox" name="is_active">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button type="submit" class="btn btn-primary px-4"><i class="fa fa-save"></i> Save</button>
        </div>
    </fieldset>
</form>
</div>