<form action="{{route('admin.global-setting.edit-main-category',$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <fieldset class="form-fieldset">
                        <legend>Main Category Infformation</legend>
                        <div class="row">
                      <div class="form-group col-lg-6">
                            <label for="" class="form-label fw-bold">Category Name<span
                                    class="text-danger">*</span></label>
                            <input type="text" value="{{$category->category_name ?? ''}}" name="category_name" class="form-control"
                                placeholder="Enter Category Name...">
                        </div>
                      
                        <div class="form-group col-lg-6">
                            <label for="" class="form-label fw-bold">Category Slug<span
                                    class="text-danger">*</span></label>
                            <input type="text"  value="{{$category->category_slug ?? ''}}" name="category_slug" class="form-control"
                                placeholder="Enter Category Slug...">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="" class="form-label fw-bold">Category Icon</label>
                            <input type="file" name="category_icon" class="form-control"
                                placeholder="Enter Category Icon...">
                            <span class="text-danger fw-bold">**Select if you want to be changed</span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="" class="form-label fw-bold">Category Status<span
                                    class="text-danger">*</span></label>
                            <select name="status" class="form-select" id="">
                                <option {{$category->status == 'yes' ? 'checked' : ''}} value="yes" selected>Active</option>
                                <option {{$category->status == 'no' ? 'checked' : ''}} value="no">De-Active</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="" class="form-label fw-bold">Category Remark<span
                                    class="text-danger">*</span></label>
                            <textarea name="remark" class="form-control" cols="2" rows="2" placeholder="Category Remark..">{{$category->remark ?? ''}}</textarea>
                        </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary px-4" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancle</button>
                    <button type="submit" class="btn btn-primary px-4"><i class="fa fa-plus"></i> Submit</button>
                </div>

            </form>