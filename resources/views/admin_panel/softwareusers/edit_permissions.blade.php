<!-- Extending master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- Extending master layout here -->


@section('main-content')
    {{-- main section start here --}}
    @php
        $permissionArray = $user->permissions->pluck('permission_id')->toArray();
        $permissionGroupIds = collect($user->permissions)
            ->pluck('cmsPermissionGroup.permission_group')
            ->toArray();
    @endphp
    {{-- message section start here --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '{{ $error }}\n';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                text: errorMessages,
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    {{-- message section end here --}}

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.users-roles.users') }}"> Users-Roles</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit-Software-Users</li>
        </ol>
    </nav>
    {{-- table section start here --}}
    <div class="custom-card col-lg-11 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Edit Software Users</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 vhr mt-3">
                    {{-- form section start here --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('admin.users-roles.edit-users-permission', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset class="form-fieldset">
                                    <legend>Software User Information</legend>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->name ?? '' }}"
                                                name="name" placeholder="User Name..." required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Contact No.<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->contact_no ?? '' }}"
                                                name="contact_no" placeholder="User Contact No...." required>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Email<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ $user->email ?? '' }}" class="form-control"
                                                name="email" placeholder="User Email..." required>
                                        </div>


                                        <div class="col-sm-3">
                                            <label for="" class="form-label">System IP Address<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ $user->ip_address ?? '' }}" class="form-control"
                                                name="ip_address" placeholder="User IP Address..." required>
                                        </div>



                                        <div class="col-sm-3">
                                            <label for="" class="form-label">Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="password"
                                                value="{{ $user->plain_password ?? '' }}" placeholder="User Password..."
                                                required>
                                        </div>



                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Image</label>
                                            <input type="file" class="form-control" name="user_image"
                                                placeholder="User ...">
                                        </div>



                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Role</label>
                                            <select name="role" {{ $user->role }} value="{{ old('role') }}"
                                                class="form-select" id="">
                                                <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">Admin
                                                </option>
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="" class="form-label">Status</label>
                                            <select name="status" value="{{ old('status') }}" class="form-select"
                                                id="">
                                                <option value="yes" {{ $user->status == 'yes' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="no" {{ $user->status == 'no' ? 'selected' : '' }}>
                                                    In-Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                        </div>
                    </div>
                    {{-- form section end here --}}


                    {{-- table section start here --}}
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <th class="fw-bold w-25">Permission Name</th>
                                    <th class="fw-bold  text-center">Permission</th>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($permissions as $permission)
                                        <tr style="height: 30px !important;">
                                            <td class="fs-10 p-2">{{ $permission->permission_group ?? '' }}</td>
                                            <td class="p-2 text-center">
                                                <input type="checkbox" class="group-checkbox"
                                                    data-group-id="{{ $permission->id }}" name="" id="">
                                            </td>
                                            <td class="w-75">
                                                <div class="accordion"
                                                    id="accordion{{ $permission->permission_group ?? '' }}">

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading{{ $count }}">
                                                            <button
                                                                class="accordion-button fs-10 {{ ++$count != 0 ? 'collapsed' : '' }}"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{ $count }}"
                                                                aria-expanded="{{ $count == 0 ? 'true' : 'false' }}"
                                                                aria-controls="collapse{{ $count }}">
                                                                {{ $permission->permission_group ?? '' }}
                                                            </button>
                                                        </h2>
                                                        <div id="collapse{{ $count }}"
                                                            class="accordion-collapse collapse {{ $count == 0 ? 'show' : '' }}"
                                                            aria-labelledby="heading{{ $count }}"
                                                            data-bs-parent="#accordion{{ $permission->permission_group ?? '' }}">
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="row px-2">
                                                                            <table class="w-100">
                                                                                <div class="col-sm-3">
                                                                                    <tr>
                                                                                        @foreach ($permission->cmsPermissionGroups as $groupPermission)
                                                                                            @if ($permission->permission_group_slug == 'attorneys')
                                                                                                @php
                                                                                                    $attorney = $attoerneys->firstWhere(
                                                                                                        'id',
                                                                                                        $groupPermission->permission_route,
                                                                                                    );
                                                                                                @endphp
                                                                                                @if ($attorney)
                                                                                                    <div class="col p-1">
                                                                                                        <td>
                                                                                                            <span
                                                                                                                class="d-flex  align-item-center fw-bold"><input
                                                                                                                    type="checkbox"
                                                                                                                    {{ in_array($attorney->id, $permissionArray) ? 'checked' : '' }}
                                                                                                                    name="permissions[]"
                                                                                                                    value="{{ $groupPermission->id ?? '' }}"
                                                                                                                    class="permission-checkbox custom-control-input"
                                                                                                                    data-group-id="{{ $permission->id }}"
                                                                                                                    id="{{ $attorney->id }}">
                                                                                                                &nbsp;
                                                                                                                {{ $attorney->attorneys_name }}</span>
                                                                                                        </td>
                                                                                                    </div>
                                                                                                @endif
                                                                                                @elseif($permission->permission_group_slug == 'category')
                                                                                                @php
                                                                                                    $mainCategory = $mainCategory->firstWhere(
                                                                                                        'category_slug',
                                                                                                        $groupPermission->permission_route,
                                                                                                    );
                                                                                                @endphp
                                                                                                @if ($mainCategory)
                                                                                                    <div class="col  p-1">
                                                                                                        <td>
                                                                                                            <span
                                                                                                                class="d-flex  align-item-center fw-bold">
                                                                                                                <input
                                                                                                                    type="checkbox"
                                                                                                                    {{ in_array($groupPermission->id, $permissionArray) ? 'checked' : '' }}
                                                                                                                    name="permissions[]"
                                                                                                                    value="{{ $groupPermission->id ?? '' }}"
                                                                                                                    class=" permission-checkbox custom-control-input"
                                                                                                                    data-group-id="{{ $permission->id }}"
                                                                                                                    id="{{ $mainCategory->id }}">
                                                                                                                &nbsp;
                                                                                                                {{ $mainCategory->category_name }}</span>
                                                                                                        </td>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @else
                                                                                                <div class="col">
                                                                                                    <td>
                                                                                                        <span
                                                                                                            class="d-flex justify-content-center align-item-center fw-bold"><input
                                                                                                                type="checkbox"
                                                                                                                name="permissions[]"
                                                                                                                {{ in_array($groupPermission->id, $permissionArray) ? 'checked' : '' }}
                                                                                                                value="{{ $groupPermission->id ?? '' }}"
                                                                                                                class=" permission-checkbox custom-control-input"
                                                                                                                data-group-id="{{ $permission->id }}"
                                                                                                                id="{{ $permission->id }}">
                                                                                                            &nbsp;
                                                                                                            {{ $groupPermission->permission_name ?? '' }}</span>
                                                                                                    </td>
                                                                                                </div>
                                                                                </div>
                                    @endif
                                    @endforeach
                        </div>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    </tr>
    @endforeach

    </tbody>
    </table>
    </div>
    </div>
    {{-- table section end here --}}


    {{-- button section start here --}}
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-end">
            <input type="reset" class="btn btn-danger me-2">
            <input type="submit" class="btn btn-primary" value="Update User">
        </div>
    </div>
    {{-- button section end here --}}
    </form>
    </div>
    </div>

    </div>
    </div>
    {{-- table section end here --}}


    {{-- javascript section start here --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).ready(function() {
                // When the group checkbox is clicked
                $('.group-checkbox').on('click', function() {
                    let groupId = $(this).data('group-id');
                    let isChecked = $(this).prop('checked');
                    $(`.permission-checkbox[data-group-id="${groupId}"]`).prop('checked',
                    isChecked);
                });

                // When the operation checkbox is clicked
                $('.operations').on('click', function() {
                    let operationId = $(this).data('operation-id');
                    let isChecked = $(this).prop('checked');
                    $(`.permission-checkbox[operation-id="${operationId}"]`).prop('checked',
                        isChecked);
                });

                // When a permission checkbox is clicked
                $('.permission-checkbox').on('click', function() {
                    let groupId = $(this).data('group-id');
                    let allChecked = $(`.permission-checkbox[data-group-id="${groupId}"]`)
                        .length ===
                        $(`.permission-checkbox[data-group-id="${groupId}"]:checked`).length;
                    $(`.group-checkbox[data-group-id="${groupId}"]`).prop('checked', allChecked);
                });

                // Check the state of group checkboxes and operation checkboxes on page load
                $('.group-checkbox').each(function() {
                    let groupId = $(this).data('group-id');
                    let allChecked = $(`.permission-checkbox[data-group-id="${groupId}"]`)
                        .length ===
                        $(`.permission-checkbox[data-group-id="${groupId}"]:checked`).length;
                    $(this).prop('checked', allChecked);
                });

                $('.operations').each(function() {
                    let operationId = $(this).data('operation-id');
                    let allChecked = $(`.permission-checkbox[operation-id="${operationId}"]`)
                        .length ===
                        $(`.permission-checkbox[operation-id="${operationId}"]:checked`).length;
                    $(this).prop('checked', allChecked);
                });
            });
        });
    </script>
@endsection
