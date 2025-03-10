<div class="mg-t-10 mg-b-5">
    @if(isset($sms)&&($sms==1))
    @php $smsmodal=1; @endphp
    <button class="w-100" id="send_communication_sms" url="{{url('MasterAdmin/Communication/ModalSMSIndex')}}" class="btn btn-brand-01 btn-sm mg-l-5 btn-uppercase mg-r-10"><i class="fa fa-envelope"></i> Communication (Send SMS/Email)</button>
    @endif

    <button class="w-100" href="{{url('/ExportFilePdf')}}" tokenid="{{csrf_token()}}" method="POST" class="btn export-pdf btn-sm pd-x-15 btn-outline-danger btn-uppercase mg-l-5 mg-r-10"><i class="fa fa-file-pdf"></i> Pdf</button>
    <button  class="w-100" @if(isset($fileName))FileName="{{$fileName}}_{{\Carbon\Carbon::now()->format('d_M_y_h_i_s')}}" @else FileName="ExcelFile_{{\Carbon\Carbon::now()->format('d_M_y_h_i_s')}}" @endif @if(isset($colspan)) colspan="{{$colspan}}" @endif FileFormat="csv" href="{{url('/ExportFile')}}" tokenid="{{csrf_token()}}" method="POST" class="btn btn-sm pd-x-15 export-excel btn-outline-info btn-uppercase mg-l-5 mg-r-10"><i class="fa fa-file-csv"></i> CSV</button>
    <button class="w-100" @if(isset($fileName))FileName="{{$fileName}}_{{\Carbon\Carbon::now()->format('d_M_y_h_i_s')}}" @else FileName="ExcelFile_{{\Carbon\Carbon::now()->format('d_M_y_h_i_s')}}" @endif @if(isset($colspan)) colspan="{{$colspan}}" @endif FileFormat="xlsx" href="{{url('/ExportFile')}}" tokenid="{{csrf_token()}}" method="POST" class="btn btn-sm pd-x-15 export-excel btn-outline-success btn-uppercase mg-l-5 mg-r-10"><i class="fa fa-file-excel"></i> Excel</button>
    <button class="w-100" href="{{url('print/1')}}" class="btn btn-sm btnPrint pd-x-15 btn-outline-primary btn-uppercase mg-l-5 "><i class="fa fa-print"></i> Print</button>
</div>
<script type="text/javascript" src="{{asset('assets/javascript/export_file_js.js')}}"></script>