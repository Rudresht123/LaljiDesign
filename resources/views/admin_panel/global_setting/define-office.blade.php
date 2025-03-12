<!-- exteinding master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- exteinding master layout here -->

@section('ModelTitle','Add New Office')
@section('ModelTitleInfo','Manage Our Offices')
@section('EditModelTitle','Edit Office')
@section('EditModelTitleInfo','Manage Our Offices')
@section('ModelSize', 'modal-lg')
@section('AddModelPage')
@include('admin_panel.global_setting.Add.add-offcie')
@endsection



@section('main-content')
    {{-- main section start here --}}

    {{-- table section satrt here --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Offices</li>
        </ol>
    </nav>

    <div class="custom-card col-lg-11 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Office List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2 mb-3">
                 

                @if(auth()->user()->hasPermission('admin.global_setting.create-office'))
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModelsData" class="btn btn-block mg-t-10 btn-outline-primary btn-sm rounded-pill w-100"><i class="fa fa-plus"></i> Add New</button>
                @endif
                @if(auth()->user()->hasPermission('admin.global_setting.edit-office'))
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
                                    <th class="text-center fw-bold">Sr. No.</th>
                                    <th class="fw-bold">Office Name</th>
                                    <th class="text-center fw-bold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offices as $office)
                                <tr deleteUrl="{{route('RecordDelete.office',$office->id)}}" editUrl="{{route('admin.global_setting.edit-office',$office->id)}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$office->office_name ?? ''}}</td>
                                    <td class="text-center">
                                    {!! $office->status == 'yes'
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


   
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-plus" aria-hidden="true"></i>
                        Edit
                        Office</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="editOfficeForm" method="POST">
                        @csrf
                        <div class="gorm-group hidden">
                            <label for="" class="form-label">Office ID <span class="text-danger">*</span></label>
                            <input type="text" id="office_id" readonly name="office_id" autocomplete="off"
                                class="form-control input-sm" required placeholder="Enter Your Office name...">
                        </div>
                        <div class="gorm-group hidden">
                            <label for="" class="form-label">Office Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="office_name" name="office_name" autocomplete="off"
                                class="form-control input-sm" required placeholder="Enter Your Office name...">
                        </div>
                        <div class="gorm-group ">
                            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status" class="form-select" id="">
                                <option value="yes">Active</option>
                                <option value="no">De-Active</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    {{-- end here add modal --}}
   
@endsection
