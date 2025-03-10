<!-- Extending master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- Extending master layout here -->



@section('ModelTitle','Add New Catgory')
@section('ModelTitleInfo','Manage Intelectual Property Category')
@section('EditModelTitle','Edit Category')
@section('EditModelTitleInfo','Manage Intelectual Property Category')
@section('ModelSize', 'modal-lg')
@section('AddModelPage')
@include('admin_panel.global_setting.Add.addmaincatgory')
@endsection


@section('main-content')
{{-- main section start here --}}

<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
        <li class="breadcrumb-item active" aria-current="page">Main-Category</li>
    </ol>
</nav>


<div class="custom-card col-lg-11 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-list"></i> Main-Category</b></div>
        <div class="panel-body pd-b-0 row">


            <div class="col-lg-2">
                @if(auth()->user()->hasPermission('admin.global-setting.create-main-category'))
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModelsData" class="btn btn-block mg-t-10 btn-outline-primary btn-sm rounded-pill w-100"><i class="fa fa-plus"></i> Add New</button>
                @endif
                @if(auth()->user()->hasPermission('admin.global-setting.edit.financialYear'))
                <button class="btn BtnEditUrl btn-block btn-outline-success btn-edit mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-edit"></i> Edit</button>
                @endif
                <a href="#" class="BtnRemoveUrl"><button type="button" class="btn btn-remove btn-block btn-outline-danger mg-t-10 btn-sm rounded-pill w-100" disabled><i class="fa fa-trash-alt"></i> Remove</button></a>

                @if(auth()->user()->hasPermission('admin.global-setting.sub-category'))
                <a href="{{ route('admin.global-setting.sub-category') }}"
                    class="btn btn-remove btn-block btn-outline-success mg-t-10 btn-sm rounded-pill w-100">
                    <i class="fa fa-plus"></i> Sub-Category
                </a>
                @endif

                @if(auth()->user()->hasPermission('admin.global-setting.show-sub-category'))
                <a href="{{ route('admin.global-setting.show-sub-category') }}" type="button"
                    class="btn btn-block btn-outline-primary mg-t-10 btn-sm rounded-pill w-100"><i class="fa fa-eye"
                        aria-hidden="true"></i> Show-Sub</a>
                @endif

                @include('admin_panel.layouts.actionbutton.ActionButton')
            </div>




            <div class="col-lg-10 vhr">
                <div class="table-responsive">
                    <table id="example2" class="table datatable w-100 table-bordered dataTable example2">
                        <thead class="bg-light fw-bold">
                            <tr class="py-3">
                                <th class="fw-bold">Category Name</th>
                                <th class="fw-bold">Remarks</th>
                                <th class="fw-bold">Slug</th>
                                <th class="fw-bold text-center">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorys as $category)
                            <tr deleteUrl="{{route('RecordDelete.MainCategory',$category->id)}}" editUrl="{{auth()->user()->hasPermission('admin.global-setting.edit-main-category') ? route('admin.global-setting.edit-main-category', $category->id) : 'noprmission' }}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->category_name ?? ''}}</td>
                                <td>{{$category->category_slug ?? ''}}</td>
                                <td class="text-center">
                                    {!! $category->status == 'yes'
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

{{-- main section start here --}}






@endsection