<fieldset class="form-fieldset mt-4">
        <legend>Consultant Information</legend>
        <div class="row">
            <div class="col-sm-4">
                <label for="" class="form-label">Consultant Name<span
                        class="text-danger">*</span></label>
                <select name="consultant" required class="form-control select2 " id="consultant">
                    <option value="">**Please Select Consultant Name..</option>
                    @foreach ($consultant as $consultant)
                    <option class="capitalize" value="{{ $consultant->id ?? '' }}">
                        {{ $consultant->consultant_name ?? '' }}
                    </option>
                    @endforeach
                </select>

            </div>
            <div class="col-sm-4">
                <label for="" class="form-label">Deal With</label>

                <select name="deal_with" class="form-control select2 ">
                    <option value="">**Please Select Dealler Name..</option>
                    @foreach ($dealWith as $dealw)
                    <option class="capitalize" value="{{ $dealw->id ?? '' }}">{{ $dealw->dealler_name ?? '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label for="" class="form-label">Filed By<span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" readonly required
                    value="{{ $attorney->attorneys_name ? $attorney->attorneys_name : '' }}"
                    name="filed_by" placeholder="Please Enter Filed Name..">
            </div>

            <div class="col-sm-6">
                <label for="" class="form-label">Remarks</label>
                <select name="remarks" class="form-select select2" id="remarks">
                    <option value="">**Please Select Remarks</option>
                    @foreach ($remarks as $remark)
                    <option class="capitalize" value="{{ $remark->id ? $remark->id : '' }}">
                        {{ $remark->remarks ? $remark->remarks : '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 ">
                <label for="" class="form-label">Client Whatsapp Remarks</label>
                <select name="client_remarks" class="form-control select2 " id="client_remarks">
                    <option value="">**Please Select Remarks</option>
                    @foreach ($clientRemarks as $cleintRemark)
                    <option class="capitalize" value="{{ $cleintRemark->id ? $cleintRemark->id : '' }}">
                        {{ $cleintRemark->client_remarks ? $cleintRemark->client_remarks : '' }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </fieldset>
