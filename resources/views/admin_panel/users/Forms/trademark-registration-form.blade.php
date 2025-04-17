<form id="registrationTrademarkForm" action="{{ route('admin.attorney.addtrademarkformdata') }}" method="POST">
    @csrf
    <fieldset class="form-fieldset">
        <legend>Basic Information</legend>
        <div class="row p-0 p-md-4">


            <div class="col-sm-4">
                <label for="" class="form-label">Attorney ID<span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="attorney_id"
                    value="{{ $attorney->id }}" readonly placeholder="Attoreny Name..">
            </div>

            <div class="col-sm-4" hidden>
                <label for="" class="form-label">Category ID<span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="category_id"
                    value="{{ $category->id }}" readonly placeholder="Attoreny Name..">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Office<span
                        class="text-danger">*</span></label>
                <select name="office_id" class="form-select" required id="office_id">
                    <option value="">**Please Office Name...</option>
                    @foreach ($offices as $office)
                    <option value="{{ $office->id ? $office->id : '' }}">
                        {{ $office->office_name ? $office->office_name : '' }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Application No.<span
                        class="text-danger">*</span></label>
                <input type="text" value="{{ old('application_no') }}" class="form-control"
                    required name="application_no" placeholder="Application Number..">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Firm Name<span
                        class="text-danger">*</span></label>
                <input type="text" value="{{ old('file_name') }}" class="form-control" required
                    name="file_name" placeholder="File Name..">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Trademark Name<span
                        class="text-danger">*</span></label>
                <input type="text" value="{{ old('trademark_name') }}" class="form-control"
                    required name="trademark_name" placeholder="Trademark Name..">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">TradeMark Class<span
                        class="text-danger">*</span></label>
                <select name="trademark_class" required class="form-select" id="trademarkclass">
                    <option value="">**Please Select Trademark Class...</option>
                    @foreach ($classes as $class)
                    <option value="{{ $class->class_name ? $class->class_name : '' }}">
                        {{ $class->class_name ? $class->class_name : '' }}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="col-sm-4">
                <label for="" class="form-label">Filling Date<span
                        class="text-danger">*</span></label>
                <input type="text" value="{{ old('filling_date') }}"
                    class="form-control datepicker" required name="filling_date"
                    placeholder="Filling Date..">
            </div>



            <div class="col-sm-4">
                <label for="" class="form-label">Objected Hearing Date</label>
                <input type="text" value="{{ old('objected_hearing_date') }}"
                    class="form-control datepicker" name="objected_hearing_date"
                    placeholder="Objected Hearing Date..">
            </div>





            <div class="col-sm-4">
                <label for="" class="form-label">Valid up-To</label>
                <input type="text" value="{{ old('valid_up_to') }}"
                    class="form-control datepicker" name="valid_up_to"
                    placeholder="Valid Up to..">
            </div>



            <div class="col-sm-4">
                <label for="" class="form-label">Status<span
                        class="text-danger">*</span></label>
                @include('admin_panel.components.GlobalSetting.status-registrationform-import',['class'=>'form-control input-sm','data'=>$statuss,
                'id' => 'status',
                'required'=>'required',
                'selectid' => $client['status'] ?? '',
                'class' => 'form-select status input-sm select-box',
                'name' => 'status[]',
                'statuss'=>$statuss,
                'data' => ['for' => 'sub-status', 'this_id' => 'status', 'get' => 'substatus']])


            </div>
            <div class="col-sm-4">
                <label for="" class="form-label">Sub-Status</label>
                <select name="sub_status" id="sub-status" class="form-select "
                    id="">
                    <option value="">--Please Select--</option>
                </select>
            </div>


            <div class="col-sm-4">
                <label for="" class="form-label">Deal Ammount</label>
                <input type="text" name="deal_ammount" class="form-control" placeholder="Enter Deal Ammount..">
            </div>

            {{-- conditional components start here --}}

            {{-- opposed no --}}
            <div class="col-sm-4" id="opposed_no" style="display: none;">
                <label for="" class="form-label">Opposed No..</label>
                <input type="text" value="" class="form-control" name="opposed_no"
                    placeholder="Please Enter Oppose No..">
            </div>
            {{-- opposed no --}}

            <!--opposition hearing data-->
            <div class="col-sm-4" id="opposition_hearing_date" style="display: none;">
                <label for="" class="form-label">Opposition Hearing Date<span
                        class="text-danger">*</span></label>
                <input type="text" value="{{ old('opposition_hearing_date') }}"
                    name="opposition_hearing_date" class="form-control datepicker"
                    placeholder="Opposition Hearing Date..">
            </div>
            <!--opposition hearing date end here-->

            {{-- rectification no --}}
            <div class="col-sm-4" id="rectification_no" style="display: none;">
                <label for="" class="form-label">Rectification No..</label>
                <input type="text" value="" class="form-control"
                    name="rectification_no" placeholder="Please Enter Rectification No..">
            </div>
            {{-- rectification no --}}

            {{-- opponent applicant --}}
            {{-- Opponent/Applicant --}}
            <div class="col-sm-4" id="opponent_applicant" style="display: none;">
                <label for="opponent_applicant_name" class="form-label">Opponent/Applicant</label>
                <select id="opp_app_name" name="opponent_applicant"
                    class="form-select">
                    <option value="">**Please Select..</option>
                    <option value="Opponent">Opponent</option>
                    <option value="Applicant">Applicant</option>
                </select>
            </div>
            {{-- End Opponent/Applicant --}}

            {{-- opponent applicant --}}

            {{-- applicant --}}
            <div class="col-sm-4" id="applicant_name" style="display: none;">
                <label for="" class="form-label">Applicant Name</label>
                <input type="text" value="" class="form-control" name="applicant_name"
                    placeholder="Please Enter Applicant Name..">
            </div>
            <div class="col-sm-4" id="applicant_code" style="display: none;">
                <label for="" class="form-label">Applicant Code..</label>
                <input type="text" value="" class="form-control" name="applicant_code"
                    placeholder="Please Enter Applicant Code..">
            </div>
            {{-- applicant --}}

            {{-- opponent --}}
            <div class="col-sm-4" id="opponent_name" style="display: none;">
                <label for="" class="form-label">Opponent Name</label>
                <input type="text" value="" class="form-control" name="opponent_name"
                    placeholder="Please Enter Opponent Name..">
            </div>
            <div class="col-sm-4" id="opponent_code" style="display: none;">
                <label for="" class="form-label">Opponent Code..</label>
                <input type="text" value="" class="form-control"
                    name="opponent_code" placeholder="Please Enter Opponent Code..">
            </div>
            {{-- opponent --}}



            <!--evidence last date-->
            <div class="col-sm-4" id="evidence_last_date" style="display:none;">
                <label for="" class="form-label">Evidence Last Date</label>
                <input type="text" name="evidence_last_date" value="{{ old('evidence_last_date') }}" class="form-control datepicker"
                    placeholder="Please Enter Evidence last Date...">
            </div>
            <!--evidence last date-->


            {{-- examination report --}}
            <div class="col-sm-4" id="examination_report_submitted" style="display: none;">
                <label for="" class="form-label">Examination Report Submitted</label>
                <select name="examination_report_submitted" class="form-select" id="">
                    <option value="">**Please Select Examination Report Status..</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            {{-- examination report --}}

            {{-- hearing date --}}
            <div class="col-sm-4" id="hearing_date" style="display: none;">
                <label for="" class="form-label">Hearing Date..</label>
                <input type="text" value=""
                    class="form-control datepicker" name="hearing_date"
                    placeholder="Please Enter Hearing Date..">
            </div>

            <div class="col-sm-4" id="post_hearing_remarks" style="display: none;">
                <label for="" class="form-label">Post Hearing Remarks..</label>
                <textarea class="form-control" name="post_hearing_remarks" id="" cols="1" rows="1"></textarea>
            </div>
            {{-- hearing date --}}



            {{-- conditional components start end --}}

            <div class="col-sm-12">
                <label for="" class="form-label">Trademark Sub Category</label>
                <select name="sub_category" id="sub-category" class="form-select select2"
                    id="">
                    <option value="">**Please Select Sub-Category</option>
                    @foreach ($subcategory as $subcat)
                    <option class="capitalize" value="{{ $subcat->id ? $subcat->id : '' }}">
                        {{ $subcat->subcategory ? $subcat->subcategory : '' }}
                    </option>
                    @endforeach

                </select>
            </div>
    </fieldset>

    <!-- contact infomation balde file -->
    @include('admin_panel.users.Forms.FormsTemplate.ContactInformation')
    <!-- contact infomation balde file -->



    <!-- consultant infomation balde file -->
    @include('admin_panel.users.Forms.FormsTemplate.ConsultantInformation')


    <!-- consultant infomation balde file -->

    {{-- communication information fieldset --}}
    @include('admin_panel.users.Forms.FormsTemplate.ClientCommunicationInformation')
    {{-- communication information fieldset --}}


    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="confirmCheck">
                <label class="form-check-label fs-12" for="flexCheckDefault">
                    <span class="text-danger">*</span> Please complete the form and click on the checkbox to confirm your submission.
                </label>
            </div>
        </div>
        <div class="col-sm-6  d-flex justify-content-end">
            <input type="reset" value="Reset" class="btn me-2 btn-danger px-3 py-2">
            <input type="submit" value="Submit" id="submitRegistrationForm" class="btn btn-primary px-3 py-2">
        </div>
    </div>
    </div>
</form>


{{-- script for the validations --}}
<script type="text/javascript">
    document.getElementById("registrationTrademarkForm").addEventListener("submit", function(event) {
        const selectBoxIds = ["office_id", "trademarkclass", "status", 'consultant', 'deal_with'];
        if (!validateSelectBoxes(selectBoxIds)) {
            event.preventDefault();
        }
    });

    $(document).ready(function() {
        const checkbox = $('#confirmCheck');
        const trademarkFormSubmit = $('#submitRegistrationForm');
        trademarkFormSubmit.prop('disabled', !checkbox.is(':checked'));
        checkbox.on('change', function() {
            trademarkFormSubmit.prop('disabled', !this.checked);
        });
    });
</script>

{{-- dynamic options code here on change status much more --}}
<script type="text/javascript">
    $(document).ready(function() {
        // Event listener for #status dropdown
        $('#status').on('change', function(e) {
            e.preventDefault();
            let statusSlug = $(this).find(':selected').data('slug');
            getOpptionsforStatus(statusSlug);
        });

        // Event listener for #opponent_applicant_name dropdown
        $('#opp_app_name').on('change', function(e) {
            e.preventDefault();
        
            let statusSlug = $('#status').find(':selected').data('slug'); // Fixed missing '#' in selector
            const getvalue = $(this).val();
            getOpponentApplicantNameNumber(getvalue, statusSlug);
        
        });
    });
</script>
{{-- dynamic options code here on change status much more --}}