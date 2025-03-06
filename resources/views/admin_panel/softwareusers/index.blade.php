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
    <div class="custom-card col-lg-11 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Software Users List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2 mb-3">
                    @if(auth()->user()->hasPermission('admin.users-roles.create-users'))
                    <a href="{{route('admin.users-roles.create-users')}}" type="button" class="btn btn-block mg-t-10 btn-outline-primary btn-sm rounded-pill px-4">
                        <i class="fa fa-plus"></i> Add New User
                </a>
                @endif
                <button type="button" class="btn btn-block btn-outline-dark mg-t-10 btn-sm rounded-pill px-4"><i class="fa fa-times"></i> Dashboard</button>
                <button type="button" class="btn btn-block btn-outline-success mg-t-10 btn-sm rounded-pill px-4"><i class="fa fa-print" aria-hidden="true"></i> Print PDF</button>
                </div>

                <div class="col-lg-10 vhr">
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-hover w-100 fs-10">
                            <thead class="bg-light fw-bold">
                                <tr class="py-3">
                                    <th class="fw-bold">User Name</th>
                                    <th class="fw-bold">User Ip Address</th>
                                    <th class="fw-bold">User Email</th>
                                    <th class="fw-bold">User Password</th>
                                    <th class="fw-bold">Contact No</th>
                                    <th class="fw-bold">Status</th>
                                    <th class="fw-bold">Action</th>

                                </tr>
                            </thead>
                            <tbody>

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

            let columnsDefinition = [
                {
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
