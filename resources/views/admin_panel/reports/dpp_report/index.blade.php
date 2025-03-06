{{-- extending master layout here --}}
@extends('admin_panel.comman.masterLayout')
{{-- extending master layout here --}}

@section('main-content')



    {{-- main section start here --}}
<div class="contain-fluid px-3">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item " aria-current="page">Clients-Reports</li>
                        <li class="breadcrumb-item active" aria-current="page">DPP-Reports</li>
                    </ol>
                </nav>
            </div>
         
        </div>
    </div>


    <!-- table section start here -->
    <div class="custom-card col-lg-12 mx-auto mb-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row mb-4 border-bottom pb-2">
                    <div class="col-sm-8">
                        <b><i class="fa fa-list"></i> Clients DPP Report</b>
                    </div>
                </div>
            </div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 vhr">
                    <fieldset class="form-fieldset">
                        <legend>DPP Report Client Information</legend>
                        <form  action="{{route('admin.client-get-dpp-reports')}}"  method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="" class="form-label">Select Financial Year</label>
                                <select name="financial_year" class="form-select select2" id="">
                                    <option value="">**Please Select Financial Year</option>
                                    @foreach($financial_year as $year)
                                    <option value="{{ $year->id ?? '' }}" 
    @if(isset($searchdata['financial_year']) && $searchdata['financial_year'] == $year->id) selected @endif>
    {{ $year->financial_session ?? '' }}
</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="" class="form-label">Select Category</label>
                            <select name="category" class="form-select select2" id="">
                                <option value="">**Select Category</option>
                                @foreach ($maincategory as $mcategory)
                                <option class="capitalize"  
    @if(isset($searchdata['category']) && $searchdata['category'] == $mcategory->id) selected @endif
    value="{{ $mcategory->id ?? '' }}">
    {{ $mcategory->category_name ?? '' }}
</option>

                                            @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="" class="form-label">Select Client <sup class="text-danger">*</sup></label>
                                <select name="client_name" id="sub-category" required class="form-select select2"
                                            id="">
                                            <option value="">**Please Select Client</option>
                                            @foreach ($clients as $clients)
                                            <option class="capitalize"  
    @if(isset($searchdata['client_name']) && $searchdata['client_name'] == $clients->file_name) selected @endif 
    style="border:1px solid black;"  
    value="{{ $clients->file_name ?? '' }}">
    <span style="font-size: 8px !important;">
        {{ $clients->application_no ?? '' }} - {{ $clients->file_name ?? '' }}
    </span>
</option>
@endforeach
                        </select>
                            </div>
                            <div class="col-lg-2" style="padding-top: 18px;">
                                
                                <input type="submit" class="btn btn-primary w-100" value="Get Report">

                            </div>
                            <div class="col-lg-2" style="padding-top: 18px;">
                               <button 
    id="{{ auth()->user()->hasPermission('admin.dpp-repots.export') ? 'exportClientsData' : '' }}" 
    class="btn btn-primary w-100" 
    {{ auth()->user()->hasPermission('admin.dpp-repots.export') ? '' : 'disabled' }}>
    <i class="fa fa-download" aria-hidden="true"></i> Get Excel Report
</button>

                                       </div>
                        </div>
                        </form>
                    </fieldset>
                </div>
                <!-- table section start here -->
              
                <div class="col-lg-12 vhr mt-4">
                @if(isset($searchclients))
                <div class="table-responsive">
                        <table id="mainCategorytable" class="table table-hover fs-12 w-100 text-center">
                            <thead class="bg-light fw-bold">
                                <tr class="py-3">
                                    <th class="fw-bold text-center">Sr. No.</th>
                                    <th class="fw-bold">Application No</th>
                                    <th class="fw-bold text-center">TM Name</th>
                                    <th class="fw-bold">Company Name</th>
                                    <th class="fw-bold">Class</th>
                                    <th class="fw-bold">Valid Up-To</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <form id="fillterFormData" action="{{route('admin.dpp-repots.export')}}" method="POST">
                            @csrf
                            <tbody>
                                @if(isset($searchclients))
                                @foreach($searchclients as $clientdata)
                                <input type="hidden"  name="clients_id[]"  value="{{$clientdata->id ?? '11'}}">
                                <input type="hidden"  name="category_id[]"  value="{{$clientdata->category_id ?? '11'}}">
                                <input type="hidden"  name="financial_year[]"  value="{{$clientdata->financial_year ?? ''}}">
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $clientdata->application_no ?? ''}}</td>
                                    <td>{{ $clientdata->trademark_name ?? ''}}</td>
                                    <td>{{ $clientdata->file_name ?? ''}}</td>
                                    <td>{{ $clientdata->trademark_class ?? ''}}</td>
                                    <td>{{ $clientdata->valid_up_to ?? ''}}</td>
                                    <td><span class="badge text-bg-success">{{ $clientdata->statusMain->status_name ?? ''}}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                            </form>
                            @endif
                        </table>
                    </div>
                </div>
                @endif
                <!-- table section start here -->

            </div>

        </div>
    </div>
    <!-- table section end here -->

    {{-- export data code start here --}}
 
<script type="text/javascript">
        $(document).ready(function() {
            $('#exportClientsData').on('click', function(e) {
                e.preventDefault();
                $('#ld').show();
                $('#overlay').show();

                let formData = $('#fillterFormData').serialize();

                $.ajax({
                    url: "{{ route('admin.dpp-repots.export') }}",
                    type: "POST",
                    data: formData,
                    xhrFields: {
                        responseType: 'blob' // Important for downloading a file
                    },
                    success: function(response, status, xhr) {

                        // Get the filename from Content-Disposition header
                        let filename = "";
                        let disposition = xhr.getResponseHeader('Content-Disposition');
                        if (disposition && disposition.indexOf('attachment') !== -1) {
                            let matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(
                                disposition);
                            if (matches != null && matches[1]) {
                                filename = matches[1].replace(/['"]/g, '');
                            }
                        }

                        // Create a link element for download
                        let link = document.createElement('a');
                        let url = window.URL.createObjectURL(response);
                        link.href = url;
                        link.download = filename ? filename :
                            'exported_data.xlsx'; // Fallback filename
                        document.body.appendChild(link);
                        link.click();
                        window.URL.revokeObjectURL(url);
                        link.remove();
                        $('#ld').hide();
                        $('#overlay').hide();
                        // Show SweetAlert success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your Excel file has been downloaded.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function() {
                        $('#ld').hide();
                        $('#overlay').hide();
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong during the export.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

        });
    </script>

@endsection