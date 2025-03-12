
<form action="{{route('admin.global-setting.create-excelcolumn')}}" method="POST">
                    @csrf
                    <fieldset class="form-fieldset mx-3 mb-3">
                        <legend>ExcelColumn Information</legend>
                        <div class="gorm-group ">
                            <label for="" class="form-label">TableColumn Name
                                <span class="text-danger">*</span></label>
                            <select name="column_name" required class="form-select" id="">
                                <option value="">**Please Select Column Name</option>
                                @foreach ($newcolumnname as $column)
                                <option value="{{$column}}">{{$column}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="gorm-group ">
                            <label for="" class="form-label">ExcelColumn Name <span
                                    class="text-danger">*</span></label>
                            <input name="excelcolumn_name" type="text" class="form-control" required placeholder="ExcelColumn Name...">
                        </div>
                        <div class="gorm-group ">
                            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
                            <select class="form-select" name="status" id="">
                                <option value="yes">Active</option>
                                <option value="no">De-Active</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-3 d-flex  justify-content-end">
            <button type="button" class="btn btn-secondary px-4 me-2" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button type="submit" class="btn btn-primary px-4"><i class="fa fa-plus"></i> Save</button>
        </div>
                    </fieldset>
                </form>