<form action="{{route('admin.global-setting.update-dealler',$dealer->id)}}" method="POST">
    @csrf
    @method("PUT")
    <fieldset class="form-fieldset m-4">
        <legend>Dealer Information</legend>
        <div class="gorm-group ">
            <label for="" class="form-label">Dealer Name <span
                    class="text-danger">*</span></label>
            <input name="dealler_name" value="{{$dealer->dealler_name ?? ''}}" type="text" class="form-control" required placeholder="dealler Name...">
        </div>
        <div class="gorm-group ">
            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
            <select class="form-select" name="status" id="">
                <option value="yes" {{$dealer->status == 'yse' ? 'selected' : ''}}>Active</option>
                <option value="no" {{$dealer->status == 'no' ? 'selected' : ''}}>De-Active</option>
            </select>
        </div>
        <div class="col-lg-12 mt-3 d-flex  justify-content-end">
            <button type="button" class="btn btn-secondary px-4 me-2" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button type="submit" class="btn btn-primary px-4"><i class="fa fa-plus"></i> Save</button>
        </div>
    </fieldset>
</form>