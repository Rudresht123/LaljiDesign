
<form action="{{route('admin.global_setting.create-office')}}" method="POST">
                        @csrf
                        <fieldset class="m-3 form-fieldset">
                            <legend>Office Information</legend>
                        <div class="gorm-group ">
                            <label for="" class="form-label">Office Name <span class="text-danger">*</span></label>
                            <input type="text" name="office_name" autocomplete="off" class="form-control input-sm"
                                required placeholder="Enter Office name">
                        </div>
                        <div class="gorm-group ">
                            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status" class="form-select" id="">
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