<form action="{{route('admin.global-setting.update-excelcolumn',$excelcolumn->id)}}" method="POST">
    @csrf
    @method("PUT")
    <fieldset class="form-fieldset mx-3 mb-3">
        <legend>ExcelColumn Information</legend>
        <div class="gorm-group ">
            <label for="" class="form-label">TableColumn Name
                <span class="text-danger">*</span></label>
            <select name="column_name" required class="form-select" id="">
                <option value="">**Please Select Column Name</option>
                @foreach ($tableColumns as $column)
                <option value="{{ $column }}" {{ $excelcolumn->column_name == $column ? 'selected' : '' }}>{{ $column }}</option>
                @endforeach
            </select>
        </div>

        <div class="gorm-group ">
            <label for="" class="form-label">ExcelColumn Name <span
                    class="text-danger">*</span></label>
            <input name="excelcolumn_name" value="{{$excelcolumn->excelcolumn_name ?? ''}}" type="text" class="form-control" required placeholder="ExcelColumn Name...">
        </div>
        <div class="gorm-group ">
            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
            <select class="form-select" name="status" id="">
                <option value="yes" {{$excelcolumn->status == 'yse' ? 'selected' : ''}}>Active</option>
                <option value="no" {{$excelcolumn->status == 'no' ? 'selected' : ''}}>De-Active</option>
            </select>
        </div>
        <div class="col-lg-12 mt-3 d-flex  justify-content-end">
            <button type="button" class="btn btn-secondary px-4 me-2" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button type="submit" class="btn btn-primary px-4"><i class="fa fa-plus"></i> Save</button>
        </div>
    </fieldset>
</form>