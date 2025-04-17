<fieldset class="form-fieldset mt-4">
        <legend>Client Communication Information</legend>
        <div class="row">
            <div class="col-sm-4">
                <label for="" class="form-label">IP Field <span
                        class="text-danger">*</span></label>
                <input type="text" value="{{ $category->category_name }}" name="ip_field"
                    readonly class="form-control" placeholder="Name Of IP Field...">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Email Recived Date</label>
                <input type="text" value="{{ old('email_recived_date') }}"
                    class="form-control datepicker" name="mail_recived_date"
                    placeholder="Email Recived Date 2..">
            </div>
            <div class="col-sm-4">
                <label for="" class="form-label">Email Recived Date 2</label>
                <input type="text" value="{{ old('email_recived_date_2') }}"
                    class="form-control datepicker" name="mail_recived_date_2"
                    placeholder="Email Recived Date 2..">
            </div>

            <div class="col-sm-6">
                <label for="" class="form-label">Email Remarks</label>
                <textarea class="form-control" name="email_remarks" placeholder="Please Enter Client Email Remarks..."
                    id="" cols="2" rows="2">{{old('email_remarks')}}</textarea>

            </div>

            <div class="col-sm-6">
                <label for="" class="form-label">Client Communication</label>
                <textarea class="form-control" name="client_communication"
                    placeholder="Please Enter Client Communication Feedback Here..." id="" cols="2" rows="2">{{old('client_communication')}}</textarea>
            </div>

        </div>
    </fieldset>