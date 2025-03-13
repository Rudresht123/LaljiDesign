<!-- exteinding master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- exteinding master layout here -->


@section('ModelTitle','Add New Status')
@section('ModelTitleInfo','Manage Intelectual Property Status')
@section('EditModelTitle','Edit Category')
@section('EditModelTitleInfo','Manage Intelectual Property Status')
@section('ModelSize', 'modal-lg')
@section('AddModelPage')
@include('admin_panel.global_setting.Add.add-status')
@endsection


@section('main-content')
{{-- main section start here --}}

{{-- table section satrt here --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
        <li class="breadcrumb-item active" aria-current="page">Define-Status</li>
    </ol>
</nav>

<div class="custom-card col-lg-11 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-list"></i> Status List</b></div>
        <div class="panel-body pd-b-0 row">
            <div class="col-lg-2 mb-3 pt-lg-5">
                @if(auth()->user()->hasPermission('admin.global-setting.create-status'))
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModelsData" class="btn btn-block mg-t-10 btn-outline-primary btn-sm rounded-pill w-100"><i class="fa fa-plus"></i> Add New</button>
                @endif
                @if(auth()->user()->hasPermission('admin.global-setting.edit-status'))
                <button class="btn BtnEditUrl btn-block btn-outline-success btn-edit mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-edit"></i> Edit</button>
                @endif
                <a href="#" class="BtnRemoveUrl"><button type="button" class="btn btn-remove btn-block btn-outline-danger mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-trash-alt"></i> Remove</button></a>

                @if(auth()->user()->hasPermission('admin.global-setting.create-sub-status'))
                <a href="{{route('admin.global-setting.create-sub-status')}}" class="btn btn-block btn-outline-primary mg-t-10 btn-sm rounded-pill w-100"><i
                        class="fa fa-times"></i> Add Sub-Status</a>
                @endif
                @if(auth()->user()->hasPermission('admin.global-setting.sub-status'))
                <a href="{{route('admin.global-setting.sub-status')}}" class="btn btn-block btn-outline-primary mg-t-10 btn-sm rounded-pill w-100"><i
                        class="fa fa-print" aria-hidden="true"></i> Show-Sub-Status</a>
                @endif
                @include('admin_panel.layouts.actionbutton.ActionButton')
            </div>

            <div class="col-lg-10 vhr">
                <div class="table-responsive">
                    <table id="example2" class="table datatable w-100 table-bordered dataTable example2">
                        <thead class="bg-light fw-bold">
                            <tr class="py-3">
                                <th class="text-center">Sr. No.</th>
                                <th class="fw-bold">Status name</th>
                                <th class="fw-bold">Remark</th>
                                <th class="fw-bold">Slug</th>
                                <th class="fw-bold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($status as $status)
                            <tr deleteUrl="{{route('RecordDelete.status',$status->id ?? '')}}" editUrl="{{ route('admin.global-setting.edit-status',$status->id)}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$status->status_name ?? ''}}</td>
                                <td>{{$status->remark ?? ''}}</td>
                                <td>{{$status->slug ?? ''}}</td>
                                <td class="text-center">
                                    {!! $status->status == 'yes'
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



@endsection