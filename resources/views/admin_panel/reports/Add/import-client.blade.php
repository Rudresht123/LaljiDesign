<form action="{{route('admin.excels-import.clients-import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form-fieldset m-3">
                        <legend>Import Clients Data</legend>

                        <div class="form-group">
                            <label for="mcategory" class="form-label">Select Category<span
                                    class="text-danger">*</span></label>
                            <select name="category_slug" required id="category_slug" class="form-select">
                                <option value="">Select a category</option> <!-- Placeholder option -->
                                @foreach ($mcategories as $mcategory)
                                <!-- Ensure $mcategories is passed to the view -->
                                <option value="{{ $mcategory->category_slug }}">{{ $mcategory->category_name }}
                                </option>
                                <!-- Adjust property as necessary -->
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="excel" class="form-label">Excel File<span
                                    class="text-danger">*</span></label>
                            <input type="file" required name="excel_file" id="excel" class="form-control"
                                accept=".xls,.xlsx"> <!-- Added accept attribute for Excel files -->
                        </div>

                        <div class="row d-flex justify-content-between">

                            <div class="col-sm-8 d-flex justify-content-between">
                                <div class="form-group fw-bold text-primary"><a target="_blank"
                                        href="{{ asset('assets/excels_formates/trademark_clients_formates.xlsx') }}"><i
                                            class="fa fa-file-excel" aria-hidden="true"></i> Trademark</a></div>
                                <div class="form-group fw-bold text-primary"><a target="_blank"
                                        href="javascript:void(0)"><i class="fa fa-file-excel" aria-hidden="true"></i>
                                        Copyright</a></div>
                                <div class="form-group fw-bold text-primary"><a target="_blank"
                                        href="javascript:void(0)"><i class="fa fa-file-excel" aria-hidden="true"></i>
                                        Design</a></div>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-end"> <button type="button"
                                    class="btn btn-secondary me-2 px-4" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                <button type="submit" class="btn btn-primary px-4"><i class="fa fa-plus"></i> Import</button>
                            </div>
                            <!-- Changed to type="submit" -->
                        </div>
            </div>
        </div>
    </div>
    </fieldset>
    </form>