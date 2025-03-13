<form action="{{route('admin.global-setting.update-permission-group',$permissiongroup->id)}}" method="POST">
    @csrf
    @method('PUT')
    <fieldset class="form-fieldset mx-4 mb-4">
        <legend>Permission Group Information</legend>
        <div class="gorm-group ">
            <label for="" class="form-label">Permission Group Name <span
                    class="text-danger">*</span></label>
            <input name="permission_group" value="{{$permissiongroup->permission_group ?? ''}}" type="text" class="form-control" required
                placeholder="Permission Group Name...">
        </div>

        <div class="gorm-group ">
            <label for="" class="form-label">Permission Group Slug <span
                    class="text-danger">*</span></label>
            <input name="permission_group_slug" type="text" value="{{$permissiongroup->permission_group_slug ?? ''}}" class="form-control" required
                placeholder="Permission Group Sulg...">
        </div>
        <div class="gorm-group ">
            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
            <select name="status" class="form-select" id="">
                <option value="yes" {{$permissiongroup->status == 'yes' ? 'selected' : ''}}>Active</option>
                <option value="no" {{$permissiongroup->status == 'no' ? 'selected' : ''}}>De-Active</option>
            </select>
        </div>
        <div class="col-lg-12 mt-3 d-flex  justify-content-end">
            <button type="button" class="btn btn-secondary px-4 me-2" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button type="submit" class="btn btn-primary px-4"><i class="fa fa-plus"></i> Save</button>
        </div>
    </fieldset>
</form>