<fieldset class="form-fieldset m-3">
    <legend>Remarks Information</legend>
    <form action="{{route('admin.global-setting.update-client-remarks',$whatsappremarks->id)}}" method="POST">
        @csrf

@method('PUT')
        <div class="gorm-group ">
            <label for="" class="form-label">Whatsapp Remarks<span
                    class="text-danger">*</span></label>
            <textarea name="client_remarks" required class="form-control" id="" cols="5" rows="5 ">{{$whatsappremarks->client_remarks ?? ''}}</textarea>
        </div>
        <div class="gorm-group ">
            <label for="" class="form-label">Is-Active<span
                    class="text-danger">*</span></label>
            <select name="status" required class="form-control" id="">
                <option value="yes" {{$whatsappremarks->status == 'yes' ? 'selected' : ''}}>Active</option>
                <option value="no" {{$whatsappremarks->status == 'no' ? 'selected' : ''}}>De-Active</option>
            </select>
        </div>
        <div class="row mt-3">
            <div class="col  d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-1 px-4 p-1" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary px-4 p-1"><i class="fa fa-plus"></i> Save</button>
            </div>
        </div>

    </form>
</fieldset>