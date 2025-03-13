<!-- Extending master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- Extending master layout here -->


@section('main-content')
    {{-- main section start here --}}

{{-- message section start here --}}
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(session('error'))
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
            <li class="breadcrumb-item active" aria-current="page">Create-Software-Users</li>
        </ol>
    </nav>
    {{-- table section start here --}}
    <div class="custom-card col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Create Software Users</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 vhr mt-3">
                    {{-- form section start here --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('admin.users-roles.store-create-users') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <fieldset class="form-fieldset mt-3">
                                    <legend>Software User Information</legend>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{old('name')}}" name="name"
                                                placeholder="User Name..." required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Contact No.<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{old('contact_no')}}" name="contact_no"
                                                placeholder="User Contact No...." required>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Email<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{old('email')}}" class="form-control" name="email"
                                                placeholder="User Email..." required>
                                        </div>


                                        <div class="col-sm-3">
                                            <label for="" class="form-label">System IP Address<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{old('ip_address')}}" class="form-control" name="ip_address"
                                                placeholder="User IP Address..." required>
                                        </div>



                                        <div class="col-sm-3">
                                            <label for="" class="form-label">Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="password"
                                                placeholder="User Password..." required>
                                        </div>



                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Image</label>
                                            <input type="file" class="form-control" name="user_image"
                                                placeholder="User ...">
                                        </div>



                                        <div class="col-sm-3">
                                            <label for="" class="form-label">User Role</label>
                                            <select name="role" value="{{old('role')}}" class="form-select" id="">
                                                <option value="admin">Admin</option>
                                                <option value="user" selected>User</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="" class="form-label">Status</label>
                                            <select name="status" value="{{old('status')}}" class="form-select" id="">
                                                <option value="yes" selected>Active</option>
                                                <option value="no" >In-Active</option>
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
                        @php
                        $loopcounter=0;
                        @endphp
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
                                                       <td class="pt-2"><input type="checkbox"   name="permissions[]"   class="permission-checkbox"   value="{{ $groupPermission->id ?? '' }}"    data-group-id="{{ $permission->id }}"   ></td>
                                                       <td><input type="text" class="form-control1 bd-0 pd-b-0 pd-t-0 bg-gray-100" value="{{ $groupPermission->permission_name ?? '' }}"></td>
                                                       <td><input type="text" class="form-control1 bd-0 bg-success-light wd-30 text-center rounded-1"  value="{{ ++$loopcounter}}"></td>

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

                    {{-- table section end here --}}


                    {{-- button section start here --}}
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-end">
                         
                            <button type="reset" class="btn btn-danger me-2"><i class="fa fa-times"></i> Create User</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Create User</button>
                           
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
            $('.group-checkbox').on('click', function() {
                let groupId = $(this).data('group-id'); 
                let isChecked = $(this).prop('checked'); 
                $(`.permission-checkbox[data-group-id="${groupId}"]`).prop('checked', isChecked);
            });
            $('.operations').on('click',function(){
                let oprationId=$(this).data('operation-id');
                let isChecked=$(this).prop('checked');
                $(`.permission-checkbox[operation-id="${operationId}"]`).prop('checked',isChecked);
            });

        });
        </script>
    {{-- /datatable initialization --}}
@endsection
