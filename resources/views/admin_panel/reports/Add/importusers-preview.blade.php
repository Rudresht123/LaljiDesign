<!-- Extending master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- Extending master layout here -->

@section('main-content')


{{-- main section start here --}}
<div class="contain-fluid px-3">
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Import Clients</li>
                    <li class="breadcrumb-item active" aria-current="page">Import Clients Preview</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<!-- form section start here -->
<div class="custom-card col-lg-12 mx-auto mb-4">
    <div class="panel panel-default">
        <div class="panel-heading border-bottom">
            <b><i class="fa fa-plus"></i> Import Data</b>
        </div>
    </div>
    <div class="panel-body pd-b-0 row">
    <form action="{{route('admin.data-import')}}" method="POST">
    @csrf
        <div class="col-lg-12 vhr py-4" style="overflow-x: scroll;">
            <!-- table section start here -->
            <table class="table table-borderd table-hover" style="white-space: nowrap;">
                <thead class="bg-light p-2">
                    <tr>
                        <th>Sr. No.</th>
                        @foreach($tablehead as $thead)
                        <th class="px-5">{{$thead ?? ''}}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach($importdata as $key => $client)
                    <tr>
                        <td class="bg-light">{{ $loop->iteration }}</td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.attoerny-import',['required'=>'required','selectid'=>$client['attorney_id'],'class'=>'form-select input-sm','name'=>'attorney_id[]'])
                        </td>

                        <td>
                            @include('admin_panel.components.GlobalSetting.category-import', [
                            'required' => 'required',
                            'id' => 'category_id',
                            'selectid' => $client['category_id'] ?? '',
                            'class' => 'form-select input-sm select-box1',
                            'name' => 'category_id[]',
                            'data' => ['for' => 'status', 'this_id' => 'category_id', 'get' => 'status']
                            ])

                        </td>
                        <td>
                            <input type="text" required class="form-control input-sm" value="{{$client['application_no']}}" name="application_no[]">
                        </td>
                        <td>
                            <input type="text" required class="form-control input-sm" value="{{$client['file_name']}}" name="file_name[]">
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" value="{{$client['trademark_name']}}" name="trademark_name[]">
                        </td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.ipcalsses-import',['selectid'=>$client['trademark_class'],'class'=>'form-select input-sm','name'=>'trademark_class[]'])
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['filling_date']}}" name="filling_date[]">
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['phone_no']}}" name="phone_no[]">
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['email_id']}}" name="email_id[]">
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['objected_hearing_date']}}" name="objected_hearing_date[]">
                        </td>
                        <td>
                            <input type="text" class="form-control  input-sm" value="{{$client['opponenet_applicant_name']}}" name="opponenet_applicant_name[]">
                        </td>
                        <td>
                            <input type="text" class="form-control  input-sm" value="{{$client['opponent_applicant_code']}}" name="opponent_applicant_code[]">
                        </td>
                        <td>
                            <select name="opponent_applicant[]" class="form-select input-sm" id="">
                                <option value="APPLICANT" {{strtoupper($client['opponent_applicant'])=='APPLICANT' ? 'selected' : '' }}>APPLICANT</option>
                                <option value="OPPONENT" {{strtoupper($client['opponent_applicant'])=='OPPONENT' ? 'selected' : '' }}>OPPONENT</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['hearing_date']}}" name="hearing_date[]">
                        </td>
                        <td>
                            <input type="text" class="form-control  input-sm" value="{{$client['examination_report']}}" name="examination_report[]">
                        </td>
                        <td>
                            <input type="text" class="form-control  input-sm" value="{{$client['opposed_no']}}" name="opposed_no[]">
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['opposition_hearing_date']}}" name="opposition_hearing_date[]">
                        </td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.consultants-import',['selectid'=>$client['consultant'],'class'=>'form-select input-sm','name'=>'consultant[]'])
                        </td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.dealler-import',['selectid'=>$client['deal_with'],'class'=>'form-select input-sm','name'=>'deal_with[]'])
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" value="{{$client['filed_by']}}" name="filed_by[]">
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" value="{{$client['client_remarks']}}" name="client_remarks[]">
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" value="{{$client['remarks']}}" name="remarks[]">
                        </td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.status-import',[
                            'id' => 'status',
                            'required'=>'required',
                            'selectid' => $client['status'] ?? '',
                            'class' => 'form-select status input-sm select-box1',
                            'name' => 'status[]',
                            'data' => ['for' => 'substatus', 'this_id' => 'status', 'get' => 'substatus']])
                        </td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.substatus-import',[
                            'id' => 'sub_status',
                            'selectid' => $client['sub_status'] ?? '',
                            'class' => 'form-select substatus input-sm',
                            'name' => 'sub_status[]'])
                        </td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.offices-import',[
                            'selectid' => $client['office_id'] ?? '',
                            'class' => 'form-select  input-sm',
                            'name' => 'office_id[]'])
                        </td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.subcategory-import',[
                            'selectid' => $client['sub_category'] ?? '',
                            'class' => 'form-select  input-sm',
                            'name' => 'sub_category[]'])
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" value="{{$client['ip_field']}}" name="ip_field[]">
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" value="{{$client['email_remarks']}}" name="email_remarks[]">
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['evidence_last_date']}}" name="evidence_last_date[]">
                        </td>  
                        <td>
                            <input type="text" class="form-control input-sm" value="{{$client['client_communication']}}" name="client_communication[]">
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['mail_recived_date']}}" name="mail_recived_date[]">
                        </td>
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['mail_recived_date_2']}}" name="mail_recived_date_2[]">
                        </td> 
                        <td>
                            <input type="text" class="form-control datepicker input-sm" value="{{$client['valid_up_to']}}" name="valid_up_to[]">
                        </td>
                        <td>
                            @include('admin_panel.components.GlobalSetting.financialyears-import',[
                            'required'=>'required',
                            'selectid' => $client['financial_year'] ?? '',
                            'class' => 'form-select  input-sm',
                            'name' => 'financial_year[]'])
                        </td>   
                        <td>
                            <input type="text" class="form-control  input-sm" value="{{$client['rectification_no']}}" name="rectification_no[]">
                        </td>
                        <td>
                            <input type="text" class="form-control  input-sm" value="{{$client['post_hearing_remarks']}}" name="post_hearing_remarks[]">
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
         
            <!-- table section end here -->
        </div>
        <div class="col-lg-12 d-flex justify-content-center">
                <button class="btn btn-primary px-4"><i class="fa fa-plus"> Import</i></button>
            </div>

</form>
    </div>
</div>
<!-- form section start here -->
@endsection