
    <!-- contact information start here -->
    <fieldset class="form-fieldset mt-4">
        <legend>Contact Information</legend>
        <div class="row">
            <div class="col-sm-6" id="number-container">
                <label for="" class="form-label">Phone Number<span class="text-danger">*</span></label>

                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <input type="text" value="{{ old('phone_no') }}" class="form-control" required
                            name="phone_no[]" placeholder="Phone Number..">
                        <button type="button" class="btn btn-primary ms-2" id="add-number"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>


            <div class="col-sm-6" id="email-container">
                <label for="" class="form-label">Email ID</label>
                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <input type="email" value="{{ old('email_id') }}" class="form-control"
                            name="email_id[]" placeholder="Please Enter Email Here..">
                        <button type="button" class="btn btn-primary ms-2" id="add-email"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </fieldset>
    <!-- contact information end here -->
