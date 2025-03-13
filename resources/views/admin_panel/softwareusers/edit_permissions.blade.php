@extends('admin_panel.comman.masterLayout')

@section('main-content')

@php
    $permissionArray = $user->permissions->pluck('permission_id')->toArray();
    $permissionGroupIds = collect($user->permissions)
        ->pluck('cmsPermissionGroup.permission_group')
        ->toArray();
@endphp

{{-- Success Message --}}
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

{{-- Error Message --}}
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

{{-- Validation Error Message --}}
@if ($errors->any())
<script>
    let errorMessages = '';
    @foreach($errors->all() as $error)
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

<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users-roles.users') }}">Users-Roles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit-Software-Users</li>
    </ol>
</nav>

<div class="custom-card col-lg-12 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b><i class="fa fa-list"></i> Edit Software Users</b>
        </div>
        <div class="panel-body pd-b-0 row">

            {{-- Form Start --}}
            <form action="{{ route('admin.users-roles.edit-users-permission', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- User Information --}}
                <fieldset class="form-fieldset my-3">
                    <legend>Software User Information</legend>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="name" class="form-label">User Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="contact_no" class="form-label">User Contact No.<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="contact_no" value="{{ $user->contact_no ?? '' }}" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="email" class="form-label">User Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="ip_address" class="form-label">System IP Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="ip_address" value="{{ $user->ip_address ?? '' }}" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="password" value="{{ $user->plain_password ?? '' }}" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="user_image" class="form-label">User Image</label>
                            <input type="file" class="form-control" name="user_image">
                        </div>

                        <div class="col-sm-3">
                            <label for="role" class="form-label">User Role</label>
                            <select name="role" class="form-select">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="yes" {{ $user->status == 'yes' ? 'selected' : '' }}>Active</option>
                                <option value="no" {{ $user->status == 'no' ? 'selected' : '' }}>In-Active</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                {{-- Permission Section --}}
                <div class="row mt-4">
                    <div class="col-sm-12">
                        @foreach ($permissions as $permission)
                            <div class="accordion mb-3" id="accordion{{ $permission->permission_group ?? '' }}">
                                <div class="accordion-item">
                                    <h1 class="accordion-header "  id="heading{{ $permission->id }}">
                                        <button class="accordion-button fs-15 fw-bold text-primary" type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#collapse{{ $permission->id }}">
                                            {{ $permission->permission_group ?? '' }}
                                        </button>
                                    </h1>
                                    <div id="collapse{{ $permission->id }}" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="row">
                                                {{-- Group Checkbox --}}
                                                <div class="col-sm-12  mb-2 mx-1">
                                                    <input type="checkbox" class="group-checkbox"
                                                        data-group-id="{{ $permission->id }}">
                                                    <label><strong>Select All</strong></label>
                                                </div>

                                                @foreach ($permission->cmsPermissionGroups as $groupPermission)
                                                <div class="col-lg-3 pd-b-2 pd-t-2 pd-l-10 pd-r-10 float-left text-uppercase">
                                           <div class="container-fluid  bg-gray-100 rounded-2 bd bd-1 pd-l-10 pd-t-5 pd-b-5">
                                                <table class="col-lg-12 p-0 m-0 ">
                                                   <tr>
                                                       <td class="pt-2"><input type="checkbox"   name="permissions[]"   class="permission-checkbox"   value="{{ $groupPermission->id ?? '' }}"    data-group-id="{{ $permission->id }}"    {{ in_array($groupPermission->id, $permissionArray) ? 'checked' : '' }}></td>
                                                       <td><input type="text" class="form-control1 bd-0 pd-b-0 pd-t-0 bg-gray-100" value="{{ $groupPermission->permission_name ?? '' }}"></td>
                                                       <td><input type="text" class="form-control1 bd-0 bg-success-light wd-30 text-center rounded-3"  value="{{$loop->iteration}}"></td>

                                                   </tr>
                                               </table>
                                           </div>

                                       </div>
                                                 
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="row">
                        <div class="col-sm-12 d-flex justify-content-end">
                         
                            <button type="reset" class="btn btn-danger me-2"><i class="fa fa-times"></i> Create User</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Create User</button>
                           
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

{{-- Javascript Section --}}
<script>
    $(document).ready(function() {
     
        $('.group-checkbox').on('change', function() {
            let groupId = $(this).data('group-id');
            $('.permission-checkbox[data-group-id="' + groupId + '"]').prop('checked', this.checked);
        });

      
        $('.permission-checkbox').on('change', function() {
            let groupId = $(this).data('group-id');

          
            let totalCheckboxes = $('.permission-checkbox[data-group-id="' + groupId + '"]').length;
            let checkedCheckboxes = $('.permission-checkbox[data-group-id="' + groupId + '"]:checked').length;

           
            $('.group-checkbox[data-group-id="' + groupId + '"]').prop('checked', totalCheckboxes === checkedCheckboxes);
        });

     
        $('.group-checkbox').each(function() {
            let groupId = $(this).data('group-id');
            let totalCheckboxes = $('.permission-checkbox[data-group-id="' + groupId + '"]').length;
            let checkedCheckboxes = $('.permission-checkbox[data-group-id="' + groupId + '"]:checked').length;

        
            $(this).prop('checked', totalCheckboxes === checkedCheckboxes);
        });
    });
</script>


@endsection
