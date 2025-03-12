<form action="{{route('admin.global-setting.create-consultant')}}" method="POST">
    @csrf
    <fieldset class="form-fieldset m-4">
        <legend>Consultant Information</legend>
        <div class="gorm-group ">
            <label for="" class="form-label">Consultant Name <span
                    class="text-danger">*</span></label>
            <input name="consultant_name" type="text" class="form-control" required
                placeholder="Consultant Name...">
        </div>
        <div class="gorm-group ">
            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
            <select class="form-select" name="status" id="">
                <option value="yes">Active</option>
                <option value="no">De-Active</option>
            </select>
        </div>
        <div class="row mt-3">
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-secondary px-4 me-2"
                    data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary px-4"><i class="fa fa-plus"></i> Save</button>
            </div>
        </div>
    </fieldset>
</form>