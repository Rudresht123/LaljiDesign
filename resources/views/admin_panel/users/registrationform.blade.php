<!-- Extending master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- Extending master layout here -->


@section('main-content')
{{-- main section start here --}}

<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item" aria-current="page">Global Setting</li>
        <li class="breadcrumb-item active" aria-current="page">User Registration</li>
    </ol>
</nav>


@if (session('success'))
<script>
    var successMessage = '{{ session('
    success ') }}';
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: successMessage,
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: 'OK' // Custom text for the button
    });
</script>
@endif

@if (session('error'))
<script>
    var errorMessage = '{{ session('
    error ') }}';
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: errorMessage,
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: 'OK' // Custom text for the button
    });
</script>
@endif

@if ($errors->any())
<script>
    var validationErrors = '<ul>';
    @foreach($errors -> all() as $error)
    validationErrors += '<li>{{ $error }}</li>';
    @endforeach
    validationErrors += '</ul>';

    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: validationErrors,
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: 'OK' // Custom text for the button
    });
</script>
@endif





{{-- message code end here --}}
{{-- form-section start here --}}
{{-- table section start here --}}
<div class="custom-card col-lg-11 mx-auto">
    <div class="panel panel-default">
        <div class="panel-body pd-b-0 row">
            <div class="col-lg-12 vhr p-3">
                <div class="row mb-3 d-flex justify-content-end">
                    <div class="col-sm-12">
                        <div class="panel-heading"><b><i class="fa fa-list"></i> Attoreny :
                                {{ $attorney->attorneys_name }}</b></div>
                    </div>
                </div>
                @if ($category->category_slug === 'trademark')
                @include('admin_panel.users.Forms.trademark-registration-form')
                @elseif($category->category_slug === 'copyright')
                    @include('admin_panel.users.Forms.copyright-registration-form')
                @endif
            </div>
        </div>
    </div>
</div>
{{-- form-section start here --}}




{{-- main section end here --}}
@endsection