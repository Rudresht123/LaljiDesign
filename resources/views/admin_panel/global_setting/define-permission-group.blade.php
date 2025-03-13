<!-- exteinding master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- exteinding master layout here -->



@section('ModelTitle','Add New Permission Group')
@section('ModelTitleInfo','Manage Software permissions Name')
@section('EditModelTitle','Edit Permission Group')
@section('EditModelTitleInfo','Manage Software permissions Name')
@section('ModelSize', 'modal-lg')
@section('AddModelPage')
@include('admin_panel.global_setting.Add.add-permission-group')
@endsection



@section('main-content')
{{-- main section start here --}}

{{-- table section satrt here --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
        <li class="breadcrumb-item active" aria-current="page">Define-Permission-Group</li>
    </ol>
</nav>

<div class="custom-card col-lg-11 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-list"></i> Permission Group List</b></div>
        <div class="panel-body pd-b-0 row">
            <div class="col-lg-2 mb-3 pt-lg-5">
                @if(auth()->user()->hasPermission('admin.global-setting.create-permission-group'))
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModelsData" class="btn btn-block mg-t-10 btn-outline-primary btn-sm rounded-pill w-100"><i class="fa fa-plus"></i> Add New</button>
                @endif
                @if(auth()->user()->hasPermission('admin.global-setting.edit-permission-group'))
                <button class="btn BtnEditUrl btn-block btn-outline-success btn-edit mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-edit"></i> Edit</button>
                @endif
                @if(auth()->user()->hasPermission('RecordDelete.MainCategory'))
                <a href="#" class="BtnRemoveUrl"><button type="button" class="btn btn-remove btn-block btn-outline-danger mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-trash-alt"></i> Remove</button></a>
                @endif
                @include('admin_panel.layouts.actionbutton.ActionButton')
            </div>

            <div class="col-lg-10 vhr">
                <div class="table-responsive">
                    <table id="example2" class="table datatable w-100 table-bordered dataTable example2">
                        <thead class="bg-light fw-bold">
                            <tr class="py-3">
                                <th class="fw-bold">Permission Group Name</th>
                                <th class="fw-bold">Permission Group Slug</th>
                                <th class="fw-bold">Status</th>
                                <th class="fw-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr deleteUrl="{{route('RecordDelete.PermissionGroup',$group->id)}}" editUrl="{{ route('admin.global-setting.edit-permission-group',$group->id)}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$group->permission_group ?? ''}}</td>
                                <td>{{$group->permission_group_slug ?? ''}}</td>
                                <td class="text-center">
                                    {!! $group->status == 'yes'
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



@endsection