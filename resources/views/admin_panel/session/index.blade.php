<!-- exteinding master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- exteinding master layout here -->


@section('ModelTitle',' New Financial Year')
@section('ModelTitleInfo','Manage Financial Year')
@section('EditModelTitle','Edit Financial Year')
@section('EditModelTitleInfo','Manage Financial Year')
@section('ModelSize', 'modal-lg')
@section('AddModelPage')
@include('admin_panel.session.add')
@endsection

@section('main-content')
{{-- main section start here --}}

{{-- table section satrt here --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
        <li class="breadcrumb-item active" aria-current="page">Financial Year</li>
    </ol>
</nav>

<div class="custom-card col-lg-11 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-list"></i> Financial Year List</b></div>
        <div class="panel-body pd-b-0 row">


            <div class="col-lg-2">
                @if(auth()->user()->hasPermission('admin.global-setting.create-financialYear'))
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModelsData" class="btn btn-block mg-t-10 btn-outline-primary btn-sm rounded-pill w-100"><i class="fa fa-plus"></i> Add New</button>
                @endif
                @if(auth()->user()->hasPermission('admin.global-setting.edit.financialYear'))
                <button class="btn BtnEditUrl btn-block btn-outline-success btn-edit mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-edit"></i> Edit</button>
                @endif
                <a href="#" class="BtnRemoveUrl"><button type="button" class="btn btn-remove btn-block btn-outline-danger mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-trash-alt"></i> Remove</button></a>

                @include('admin_panel.layouts.actionbutton.ActionButton')
            </div>

            <div class="col-lg-10 vhr">
                <div class="table-responsive">
                    <table id="example2" class="table datatable w-100 table-bordered dataTable example2">
                        <thead class="bg-light fw-bold">
                            <tr class="py-3">
                                <th class="fw-bold">Sr. No.</th>
                                <th class="fw-bold">Financial Year</th>
                                <th class="fw-bold">Start Date</th>
                                <th class="fw-bold">End Date</th>
                                <th class="fw-bold text-center">Is-Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($financialyear as $fyear)
                            <tr deleteUrl="{{route('RecordDelete.FinancialYear',$fyear->id)}}" editUrl="{{ auth()->user()->hasPermission('admin.global-setting.edit.financialYear') ? route('admin.global-setting.edit.financialYear', $fyear->id) : 'nopermission' }}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$fyear->financial_session ?? ''}}</td>
                                <td>{{$fyear->start_date ?? ''}}</td>
                                <td>{{$fyear->end_date ?? ''}}</td>
                                <td class="text-center">
                                    {!! $fyear->is_active == 'yes'
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
                    Add
                    New Financial Year</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="editFinancialYear" method="POST">
                    @csrf
                    <div class="gorm-group hidden">
                        <label for="" class="form-label">Financial ID <span
                                class="text-danger">*</span></label>
                        <input type="text" id="financial_session_id" readonly name="financial_session_id"
                            autocomplete="off" class="form-control input-sm" required
                            placeholder="Enter Financial Year Like : 2019-2020">
                    </div>
                    <div class="gorm-group ">
                        <label for="" class="form-label">Financial Year <span
                                class="text-danger">*</span></label>
                        <input type="text" id="financial_session" name="financial_session" autocomplete="off"
                            class="form-control input-sm" required
                            placeholder="Enter Financial Year Like : 2019-2020">
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="" class="form-label">Start Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="financial_session" name="start_date" autocomplete="off"
                                class="form-control input-sm" required
                                placeholder="Enter Satrt Date like : dd-mm-yyyy ">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="" class="form-label">End Date<span
                                    class="text-danger">*</span></label>
                            <input type="date" id="end_date" name="end_date" required autocomplete="off"
                                class="form-control date input-sm hasDatepicker"
                                placeholder="Enter End Date (dd-mm-yyyy)">
                        </div>
                        <div class="mb-3">
                            <b>Default Active : </b> <input type="checkbox" name="is_active">
                        </div>
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