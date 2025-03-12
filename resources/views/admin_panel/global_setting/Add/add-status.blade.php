<form action="{{route('admin.global-setting.create-status')}}" method="POST">
    @csrf
    <fieldset class="form-fieldset m-3">
        <legend>Status Information</legend>
        <div class="gorm-group ">
            <label for="" class="form-label">Status Name <span
                    class="text-danger">*</span></label>
            <input type="text" name="status_name" autocomplete="off" class="form-control input-sm"
                required placeholder="Enter Status Name...">
        </div>
        <div class="gorm-group ">
            <label for="" class="form-label">Status Slug <span
                    class="text-danger">*</span></label>
            <input type="text" name="slug" autocomplete="off" class="form-control input-sm"
                required placeholder="Enter Status Slug...">
        </div>
        <div class="gorm-group ">
            <label for="" class="form-label">Status Remark</label>
            <textarea name="remark" placeholder="Please Enter Status Remark..." class="form-control" id="" cols="10" rows="5"></textarea>
        </div>
        <div class="gorm-group ">
            <label for="" class="form-label">Status</label>
            <select class="form-select" name="status" id="">
                <option value="yes">Active</option>
                <option value="no">De-Active</option>
            </select>
        </div>
        <div class="row mt-3">
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </fieldset>
</form>