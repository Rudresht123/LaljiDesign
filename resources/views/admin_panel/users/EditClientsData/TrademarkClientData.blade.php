<form id="registrationTrademarkForm"
    action="{{ route('admin.attorney.updatetrademarkformdata', $client->id) }}"
    method="POST">
    @csrf
    <fieldset class="form-fieldset">
        <legend>Basic Information</legend>
        <div class="row">


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
                    <option class="capitalize" value="{{ $office->id ? $office->id : '' }}"
                        {{ $office->id == $client->office_id ? 'selected' : '' }}>
                        {{ $office->office_name ??  '' }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Application No.<span
                        class="text-danger">*</span></label>
                <input type="text"
                    value="{{ $client->application_no ? $client->application_no : '' }}"
                    class="form-control" required name="application_no"
                    placeholder="Application Number..">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Firm Name<span
                        class="text-danger">*</span></label>
                <input type="text" value="{{ $client->file_name ? $client->file_name : '' }}"
                    class="form-control" required name="file_name" placeholder="File Name..">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Trademark Name<span
                        class="text-danger">*</span></label>
                <input type="text"
                    value="{{ $client->trademark_name ? $client->trademark_name : '' }}"
                    class="form-control" required name="trademark_name"
                    placeholder="Trademark Name..">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">TradeMark Class<span
                        class="text-danger">*</span></label>
                <select name="trademark_class" required class="form-select" id="trademarkclass">
                    <option value="">**Please Select Trademark Class...</option>
                    @foreach ($classes as $class)
                    <option class="capitalize" value="{{ $class->class_name ? $class->class_name : '' }}"
                        {{ $class->class_name == $client->trademark_class ? 'selected' : '' }}>
                        {{ $class->class_name ? $class->class_name : '' }}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="col-sm-4">
                <label for="" class="form-label">Filling Date<span
                        class="text-danger">*</span></label>
                <input type="text"
                    value="{{ $client->filling_date ? $client->filling_date : '' }}"
                    class="form-control datepicker" required name="filling_date"
                    placeholder="Filling Date..">
            </div>



            <div class="col-sm-4">
                <label for="" class="form-label">Objected Hearing Date</label>
                <input type="text"
                    value="{{ $client->objected_hearing_date ? $client->objected_hearing_date : '' }}"
                    class="form-control datepicker" name="objected_hearing_date"
                    placeholder="Objected Hearing Date..">
            </div>





            <div class="col-sm-4">
                <label for="" class="form-label">Valid up-To</label>
                <input type="text"
                    value="{{ $client->valid_up_to ? $client->valid_up_to : '' }}"
                    class="form-control datepicker" name="valid_up_to"
                    placeholder="Valid Up to..">
            </div>


            <div class="col-sm-4">
                <label for="" class="form-label">Status<span
                        class="text-danger">*</span></label>
                @include('admin_panel.components.GlobalSetting.status-registrationform-import',['class'=>'form-control input-sm','data'=>$statuss,
                'id' => 'status',
                'required'=>'required',
                'selectid' => $client->status ?? '',
                'class' => 'form-select status input-sm select-box',
                'name' => 'status[]',
                'statuss'=>$statuss,
                'data' => ['for' => 'sub-status', 'this_id' => 'status', 'get' => 'substatus']])
            </div>
            <div class="col-sm-4">
                <label for="" class="form-label">Sub-Status</label>
                <select name="sub_status" class="form-select "
                    id="sub-status">
                </select>
            </div>



            <div class="col-sm-4">
                <label for="" class="form-label">Deal Ammount</label>
                <input type="text" name="deal_ammount" value="{{$client->deal_ammount ?? ''}}" class="form-control" placeholder="Enter Deal Ammount..">
            </div>



            {{-- conditional components start here --}}

            {{-- opposed no --}}
            <div class="col-sm-4" id="opposed_no" style="display: none;">
                <label for="" class="form-label">Opposed No..</label>
                <input type="text" value="{{$client->opposed_no ?? ''}}" class="form-control" name="opposed_no"
                    placeholder="Please Enter Oppose No..">
            </div>
            {{-- opposed no --}}

            {{-- rectification no --}}
            <div class="col-sm-4" id="rectification_no" style="display: none;">
                <label for="" class="form-label">Rectification No..</label>
                <input type="text" value="{{ $client->rectification_no ?? '' }}"
                    class="form-control" name="rectification_no"
                    placeholder="Please Enter Rectification No..">
            </div>
            {{-- rectification no --}}

            <!--opposition hearing date-->
            <div class="col-sm-4" id="opposition_hearing_date" style="display: none;">
                <label for="" class="form-label">Opposition Hearing Date<span
                        class="text-danger">*</span></label>
                <input type="text"
                    value="{{ $client->opposition_hearing_date ? $client->opposition_hearing_date : '' }}"
                    name="opposition_hearing_date" class="form-control datepicker"
                    placeholder="Opposition Hearing Date..">
            </div>
            <!--opposition hearing date end here-->


            {{-- opponent applicant --}}
            {{-- Opponent/Applicant --}}
            <div class="col-sm-4" id="opponent_applicant" style="display: none;">
                <label for="opponent_applicant_name" class="form-label">Opponent/Applicant</label>
                <select id="opp_app_name" name="opponent_applicant" class="form-select">
                    <option value="">**Please Select..</option>
                    <option value="Opponent"
                        {{ \Illuminate\Support\Str::lower($client->opponent_applicant) == 'opponent' ? 'selected' : '' }}>Opponent
                    </option>
                    <option value="Applicant"
                        {{ \Illuminate\Support\Str::lower($client->opponent_applicant) == 'applicant' ? 'selected' : '' }}>Applicant
                    </option>
                </select>
            </div>
            {{-- End Opponent/Applicant --}}

            {{-- opponent applicant --}}

            {{-- applicant --}}
            <div class="col-sm-4" id="applicant_name" style="display: none;">
                <label for="" class="form-label">Applicant Name</label>
                <input type="text"
                    value="{{\Illuminate\Support\Str::lower($client->opponent_applicant) == 'opponent' ? $client->opponenet_applicant_name : '' }}"
                    class="form-control" name="applicant_name"
                    placeholder="Please Enter Applicant Name..">
            </div>
            <div class="col-sm-4" id="applicant_code" style="display: none;">
                <label for="" class="form-label">Applicant Code..</label>
                <input type="text"
                    value="{{\Illuminate\Support\Str::lower($client->opponent_applicant) == 'opponent' ? $client->opponent_applicant_code : '' }}"
                    class="form-control" name="applicant_code"
                    placeholder="Please Enter Applicant Code..">
            </div>
            {{-- applicant --}}

            {{-- opponent --}}
            <div class="col-sm-4" id="opponent_name" style="display: none;">
                <label for="" class="form-label">Opponent Name</label>
                <input type="text"
                    value="{{\Illuminate\Support\Str::lower($client->opponent_applicant) == 'applicant' ? $client->opponenet_applicant_name : '' }}"
                    class="form-control" name="opponent_name"
                    placeholder="Please Enter Opponent Name..">
            </div>
            <div class="col-sm-4" id="opponent_code" style="display: none;">
                <label for="" class="form-label">Opponent Code..</label>
                <input type="text"
                    value="{{\Illuminate\Support\Str::lower($client->opponent_applicant) == 'applicant' ? $client->opponent_applicant_code : '' }}"
                    class="form-control" name="opponent_code"
                    placeholder="Please Enter Opponent Code..">
            </div>
            {{-- opponent --}}


            <!--evidence last date-->
            <div class="col-sm-4" id="evidence_last_date" style="display:none;">
                <label for="" class="form-label">Evidence Last Date</label>
                <input type="text" name="evidence_last_date"
                    value="{{ $client->evidence_last_date ?? '' }}"
                    class="form-control datepicker"
                    placeholder="Please Enter Evidence last Date...">
            </div>
            <!--evidence last date end here-->

            {{-- examination report --}}
            <div class="col-sm-4" id="examination_report_submitted" style="display: none;">
                <label for="" class="form-label">Examination Report Submitted</label>
                <select name="examination_report" class="form-select" id="">
                    <option value="">**Please Select Examination Report Status..</option>
                    <option value="yes" {{$client->examination_report == 'yes' ? 'selected' : ''}}>Yes</option>
                    <option value="no" {{$client->examination_report == 'no' ? 'selected' : ''}}>No</option>
                </select>
            </div>
            {{-- examination report --}}

            {{-- hearing date --}}
            <div class="col-sm-4" id="hearing_date" style="display: none;">
                <label for="" class="form-label">Hearing Date..</label>
                <input type="text" value="{{$client->hearing_date ?? ''}}" class="form-control datepicker"
                    name="hearing_date" placeholder="Please Enter Hearing Date..">
            </div>
            <div class="col-sm-4" id="post_hearing_remarks" style="display: none;">
                <label for="" class="form-label">Post Hearing Remarks..</label>
                <textarea class="form-control" name="post_hearing_remarks" id="" cols="1" rows="1">{{$client->post_hearing_remarks ?? ''}}"</textarea>
            </div>
            {{-- hearing date --}}


            {{-- for another opposed no --}}

            @if($client->opposed_no !=null)
            <div class="col-sm-4 " style="padding-top:25px;">
                <button
                    id="anotherOpposed" class="fs-14">
                    <span class="badge text-bg-danger"> <i class="fa fa-plus" aria-hidden="true"></i> Have AnyOther Opposed</span>
                </button>
            </div>
            @endif

            {{-- for another opposed no --}}


            {{-- conditional components start end --}}

            <div class="col-sm-12">
                <label for="" class="form-label">Trademark Sub Category</label>
                <select name="sub_category" id="sub-category"
                    class="form-select select2" id="">
                    <option value="">**Please Select Sub-Category</option>
                    @foreach ($subcategory as $subcat)
                    <option class="capitalize" value="{{ $subcat->id ? $subcat->id : '' }}"
                        {{ $subcat->id == $client->sub_category ? 'selected' : '' }}>
                        {{ $subcat->subcategory ? $subcat->subcategory : '' }}
                    </option>
                    @endforeach

                </select>
            </div>
    </fieldset>


    <!-- contact information start here -->
    <fieldset class="form-fieldset mt-4">
        <legend>Contact Information</legend>
        <div class="row">
            <div class="col-sm-6" id="number-container">
                @php
                if(isset($client->phone_no)){
                $phones = explode(',', $client->phone_no);
                }
                @endphp

                @if(!empty($phones))
                @foreach($phones as $phone)
                <label for="" class="form-label">Phone Number {{$loop->iteration}}<span class="text-danger">*</span></label>
                <div class="row removefield">
                    <div class="col-lg-12 d-flex">
                        <input type="text" value="{{ $phone ?? '' }}" class="form-control"
                            @if($loop->first) required @endif
                        name="phone_no[]" placeholder="Phone Number..">
                        @if($loop->iteration ==1)
                        <button type="button" class="btn btn-primary ms-2" id="add-number"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        @endif
                        <button type="button" class="btn btn-danger remove-field ms-2">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-sm-12" id="number-container">
                    <label for="" class="form-label">Phone Number<span class="text-danger">*</span></label>

                    <div class="row">
                        <div class="col-lg-12 d-flex">
                            <input type="text" value="" class="form-control" required
                                name="phone_no[]" placeholder="Phone Number..">
                            <button type="button" class="btn btn-primary ms-2" id="add-number"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                @endif
            </div>


            <div class="col-sm-6" id="email-container">
                @php
                $emails = isset($client->email_id) ? explode(',', $client->email_id) : [];
                @endphp
                @if($emails)
                @foreach($emails as $email)
                <div class="row removefield">
                    <label for="" class="form-label ms-3">
                        Email ID {{ $loop->iteration }}
                    </label>
                    <div class="col-lg-12 d-flex">
                        <input type="email" value="{{ $email ?? '' }}" class="form-control" name="email_id[]" placeholder="Please Enter Email Here..">

                        @if($loop->first)
                        <button type="button" class="btn btn-primary ms-2" id="add-email">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                        @endif

                        <button type="button" class="btn btn-danger remove-field ms-2">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                @endforeach
                @else

                <div class="col-sm-12" id="email-container">
                    <label for="" class="form-label">Email ID</label>
                    <div class="row">
                        <div class="col-lg-12 d-flex">
                            <input type="email" value="" class="form-control"
                                name="email_id[]" placeholder="Please Enter Email Here..">
                            <button type="button" class="btn btn-primary ms-2" id="add-email"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </fieldset>
    <!-- contact information end here -->

    <fieldset class="form-fieldset mt-4">
        <legend>Consultant Information</legend>
        <div class="row">
            <div class="col-sm-4">
                <label for="" class="form-label">Consultant Name<span
                        class="text-danger">*</span></label>
                <select name="consultant" required class="form-select" id="consultant">
                    <option value="">**Please Select Consultant Name..</option>
                    @foreach ($consultant as $consultant)
                    <option class="capitalize" value="{{ $consultant->id ?? '' }}"
                        {{ $consultant->id == $client->consultant ? 'selected' : '' }}>
                        {{ $consultant->consultant_name ?? '' }}
                    </option>
                    @endforeach
                </select>

            </div>
            <div class="col-sm-4">
                <label for="" class="form-label">Deal With</label>

                <select name="deal_with" class="form-select" id="deal_with">
                    <option value="">**Please Select Dealler Name..</option>
                    @foreach ($dealWith as $dealw)
                    <option class="capitalize" value="{{ $dealw->id ?? '' }}"
                        {{ $dealw->id == $client->deal_with ? 'selected' : '' }}>
                        {{ $dealw->dealler_name ?? '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label for="" class="form-label">Filed By<span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" readonly required
                    value="{{ $client->filed_by ? $client->filed_by : '' }}" name="filed_by"
                    placeholder="Please Enter Filed Name..">
            </div>

            <div class="col-sm-6">
                <label for="" class="form-label">Remarks</label>
                <select name="remarks" class="form-select select2" id="remarks">
                    <option value="">**Please Select Remarks</option>
                    @foreach ($remarks as $remark)
                    <option class="capitalize" value="{{ $remark->id ? $remark->id : '' }}"
                        {{ $remark->id == $client->remarks ? 'selected' : '' }}>
                        {{ $remark->remarks ? $remark->remarks : '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 ">
                <label for="" class="form-label">Client Whatsapp Remarks</label>
                <select name="client_remarks" class="form-control select2 "
                    id="client_remarks">
                    <option value="">**Please Select Remarks</option>
                    @foreach ($clientRemarks as $cleintRemark)
                    <option class="capitalize" value="{{ $cleintRemark->id ? $cleintRemark->id : '' }}"
                        {{ $cleintRemark->id == $client->client_remarks ? 'selected' : '' }}>
                        {{ $cleintRemark->client_remarks ? $cleintRemark->client_remarks : '' }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </fieldset>

    {{-- communication information fieldset --}}
    <fieldset class="form-fieldset mt-4">
        <legend>Client Communication Information</legend>
        <div class="row">
            <div class="col-sm-4">
                <label for="" class="form-label">IP Field <span
                        class="text-danger">*</span></label>
                <input type="text"
                    value="{{ $client->ip_field ? $client->ip_field : 'Hello' }}" name="ip_field"
                    readonly class="form-control" placeholder="Name Of IP Field...">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Email Recived Date</label>
                <input type="text" value="{{ $client->mail_recived_date ?? '' }}"
                    class="form-control datepicker" name="mail_recived_date"
                    placeholder="Email Recived Date 2..">
            </div>
            <div class="col-sm-4">
                <label for="" class="form-label">Email Recived Date 2</label>
                <input type="text" value="{{ $client->mail_recived_date_2 ?? '' }}"
                    class="form-control datepicker" name="mail_recived_date_2"
                    placeholder="Email Recived Date 2..">
            </div>

            <div class="col-sm-8">
                <label for="" class="form-label">Email Remarks</label>
                <textarea class="form-control" name="email_remarks" placeholder="Please Enter Client Email Remarks..."
                    id="" cols="1" rows="1">{{ $client->email_remarks ?? '' }}</textarea>

            </div>

            <div class="col-sm-12">
                <label for="" class="form-label">Client Communication</label>
                <textarea class="form-control" name="client_communication"
                    placeholder="Please Enter Client Communication Feedback Here..." id="" cols="2" rows="2">{{ $client->client_communication ?? '' }}</textarea>
            </div>

        </div>
    </fieldset>
    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value=""
                    id="confirmCheck">
                <label class="form-check-label fs-12" for="flexCheckDefault">
                    <span class="text-danger">*</span> Please complete the form and click on the
                    checkbox to confirm your submission.
                </label>
            </div>
        </div>
        <div class="col-sm-6  d-flex justify-content-end">
            <input type="reset" value="Reset" class="btn me-2 btn-danger px-3 py-2">
            <input type="submit" value="Submit" id="submitRegistrationForm"
                class="btn btn-primary px-3 py-2">
        </div>
    </div>
    </div>
</form>