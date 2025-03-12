<!-- exteinding master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- exteinding master layout here -->


@section('ModelTitle','Add New Whatsapp Remarks')
@section('ModelTitleInfo','Manage Whatsapp Remarks')
@section('EditModelTitle','Edit Whatsapp Remarks')
@section('EditModelTitleInfo','Manage Whatsapp Remarks')
@section('ModelSize', 'modal-lg')
@section('AddModelPage')
@include('admin_panel.global_setting.Add.add-whatsapp-remarks')
@endsection

@section('main-content')
{{-- main section start here --}}

{{-- table section satrt here --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
        <li class="breadcrumb-item active" aria-current="page">Whatsapp-Remarks</li>
    </ol>
</nav>

<div class="custom-card col-lg-11 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-list"></i> Whatsapp Remarks List</b></div>
        <div class="panel-body pd-b-0 row">
            <div class="col-lg-2 mb-3">
                @if(auth()->user()->hasPermission('admin.global-setting.create-client-remarks'))
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModelsData" class="btn btn-block mg-t-10 btn-outline-primary btn-sm rounded-pill w-100"><i class="fa fa-plus"></i> Add New</button>
                @endif
                @if(auth()->user()->hasPermission('admin.global-setting.edit-client-remarks'))
                <button class="btn BtnEditUrl btn-block btn-outline-success btn-edit mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-edit"></i> Edit</button>
                @endif
                @if(auth()->user()->hasPermission('RecordDelete.WhatsappRemarks'))
                <a href="#" class="BtnRemoveUrl"><button type="button" class="btn btn-remove btn-block btn-outline-danger mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-trash-alt"></i> Remove</button></a>
                @endif
                @include('admin_panel.layouts.actionbutton.ActionButton')
            </div>

            <div class="col-lg-10 vhr">
                <div class="table-responsive">
                    <table id="example2" class="table datatable w-100 table-bordered dataTable example2">
                        <thead class="bg-light fw-bold">
                            <tr class="py-3">
                                <th>Sr. No.</th>
                                <th class="text-center fw-bold">Whatsapp Remarks</th>
                                <th class="fw-bold">Is-Active</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($whatsappremarks as $whatsappremark)
                            <tr deleteUrl="{{route('RecordDelete.WhatsappRemarks',$whatsappremark->id)}}" editUrl="{{route('admin.global-setting.edit-client-remarks',$whatsappremark->id)}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$whatsappremark->client_remarks}}</td>
                                <td class="text-center">
                                    {!! $whatsappremark->status == 'yes'
                                    ? '<span class="badge text-bg-success">Active</span>'
                                    : '<span class="badge text-bg-danger">In-Active</span>' !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
</div>


</div>

{{-- table section satrt here --}}



{{-- new financial moda add --}}
<!-- Button trigger modal -->

<!-- Modal -->
<!-- Button trigger modal -->


@endsection