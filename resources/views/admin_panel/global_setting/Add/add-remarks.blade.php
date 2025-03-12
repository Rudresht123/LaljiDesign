<fieldset class="form-fieldset">
                        <legend>Remarks Information</legend>
                        <form action="{{route('admin.global-setting.create-remarks')}}" method="POST">
                            @csrf


                            <div class="gorm-group ">
                                <label for="" class="form-label">Remarks<span class="text-danger">*</span></label>
                                <textarea name="remarks" required class="form-control" id="" cols="5" rows="5 "></textarea>
                            </div>
                            <div class="gorm-group ">
                                <label for="" class="form-label">Is-Active<span class="text-danger">*</span></label>
                                <select name="is_active" required class="form-control" id="">
                                    <option value="yes">Active</option>
                                    <option value="no">De-Active</option>
                                </select>
                            </div>
                            <div class="row mt-3">
                                <div class="col  d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-1 px-4 p-1"
                                        data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-primary px-4 p-1"><i class="fa fa-plus"></i> Save</button>
                                </div>
                            </div>

                        </form>
                    </fieldset>