<!-- Extending master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- Extending master layout here -->


@section('main-content')
{{-- main section start here --}}

<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item" aria-current="page">Users-Roles</li>
        <li class="breadcrumb-item active" aria-current="page">Software-Users</li>
    </ol>
</nav>


{{-- table section start here --}}
<div class="custom-card col-lg-12 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-list"></i> Software Users List</b></div>
        <div class="panel-body pd-b-0 row">
            <div class="col-lg-12 d-flex justify-content-between">
                @if(auth()->user()->hasPermission('admin.users-roles.create-users'))
                <a href="{{route('admin.users-roles.create-users')}}" type="button" class="btn export-pdf btn-sm pd-x-15 mg-t-10 mg-b-5  btn-outline-danger btn-uppercase mg-l-5 mg-r-10">
                    <i class="fa fa-plus"></i> Add New User
                </a>
                @endif
                @include('admin_panel.layouts.actionbutton.action-button-verticle')
            </div>
            <div class="col-lg-12 mt-3">
                <div class="table-responsive">
                    <table id="example2" class="table datatable w-100 table-bordered dataTable example2">
                        <thead class="bg-light fw-bold">
                            <tr class="py-3">
                                <th class="fw-bold">Sr. No.</th>
                                <th class="fw-bold">User Name</th>
                                <th class="fw-bold">User Role</th>
                                <th class="fw-bold">User Email</th>
                                <th class="fw-bold">User Password</th>
                                <th class="fw-bold">Contact No</th>
                                <th class="fw-bold">Status</th>
                                <th class="fw-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$user->name ?? ''}}</td>
                                <td>{{$user->role ?? ''}}</td>
                                <td>{{$user->email ?? ''}}</td>
                                <td>{{$user->plain_password ?? ''}}</td>
                                <td>{{$user->contact_no ?? ''}}</td>
                                <td class="text-center">
                                    {!! $user->status == 'yes'
                                    ? '<span class="badge text-bg-success">Active</span>'
                                    : '<span class="badge text-bg-danger">In-Active</span>' !!}
                                </td>
                                <td class="d-flex justify-content-center">
                                @if(auth()->user()->hasPermission('admin.users-roles.edit-users'))
                                    <a href="{{route('admin.users-roles.edit-users', $user->id)}}"
                                        class="text-primary p-1 rounded fw-bold"
                                        title="Edit Data">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(auth()->user()->hasPermission('RecordDelete.deleteSoftwareUsers'))
                                    <a href="{{route('RecordDelete.deleteSoftwareUsers',$user->id)}}" class="BtnRemoveUrl text-danger disabled"><i class="fa fa-trash-alt"></i> </a>
                                    @endif
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
{{-- table section end here --}}


{{-- javascript section start here --}}
{{-- /datatable initialization --}}
<script type="text/javascript">
    $(document).ready(function() {
        let route = "{{ route('admin.common.datatable') }}";
        let csrf = "{{ csrf_token() }}";

        let columnsDefinition = [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'ip_address',
                name: 'ip_address'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'plain_password',
                name: 'plain_password'
            },
            {
                data: 'contact_no',
                name: 'contact_no'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ];

        intializeCustomDatatable({
            route: route, // Correctly assign the route
            csrf: csrf, // Correctly assign the CSRF token
            columnsDefinition: columnsDefinition, // Assign columnsDefinition
            tableId: 'usersTable', // Assign the table ID
            dbtable: 'admins' // Assign the database table name
        });

        // block and unbloc code here

        $('#usersTable').on('click', '.blockButton', function(e) {
            e.preventDefault();
            let itemId = $(this).data('id');
            let csrf = "{{ csrf_token() }}";
            let route = "{{ route('admin.block-data') }}";
            let dbtable = "admins";
            let columnname = "status";
            showConfirmAlert(route, csrf, dbtable, columnname, itemId);
        });
        $('#usersTable').on('click', '.blockButton', function(e) {
            e.preventDefault();
            let itemId = $(this).data('id');
            let csrf = "{{ csrf_token() }}";
            let route = "{{ route('admin.block-data') }}";
            let dbtable = "admins";
            let columnname = "status";
            showConfirmAlert(route, csrf, dbtable, columnname, itemId);
        });
    });
</script>
@endsection