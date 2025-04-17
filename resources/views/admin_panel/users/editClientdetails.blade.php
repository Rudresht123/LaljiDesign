<!-- Extending master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- Extending master layout here -->


@section('main-content')
{{-- main section start here --}}

<style>
    #anotherOpposed {
        all: unset;
        display: inline-block;
        background: transparent;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        text-align: center;
    }
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item" aria-current="page">Global Setting</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Client Details</li>
    </ol>
</nav>


{{-- message code here --}}


@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('
        success ') }}',
        timer: 3000, // auto close after 3 seconds
        showConfirmButton: false
    });
</script>
@endif
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('
        error ') }}',
        timer: 3000, // auto close after 3 seconds
        showConfirmButton: false
    });
</script>
@endif
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: '<ul>' +
            @foreach($errors -> all() as $error)
        '<li>{{ $error }}</li>' +
        @endforeach '</ul>',
        showConfirmButton: true
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
                <!-- traemark client -->
                @include('admin_panel.users.EditClientsData.TrademarkClientData')
                <!-- traemark client -->
                @elseif($category->category_slug === 'copyright')

                <!-- copyright client -->
                @include('admin_panel.users.EditClientsData.CopyRightClientDetails')
                <!-- copyright client -->

                @endif
            </div>
        </div>
    </div>
</div>
{{-- form-section start here --}}



{{-- script section statr here --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#status').on('change', function(e) {
            e.preventDefault();
            let statusId = $(this).val();
            let route = "{{ route('getsubstatus', ':id') }}".replace(':id', statusId);
            populateSubstatus(route, '');
        });
        // on ready initialize substatus
        const statusId = @json($client -> status);
        const substatusId = @json($client -> sub_status);
        let route = "{{ route('getsubstatus', ':id') }}".replace(':id', statusId);
        populateSubstatus(route, substatusId);
    });
</script>
{{-- script section statr here --}}
<script type="text/javascript">
    document.getElementById("registrationTrademarkForm").addEventListener("submit", function(event) {
        const selectBoxIds = ["office_id", "trademarkclass", "status",
            'consultant'
        ];
        if (!validateSelectBoxes(selectBoxIds)) {
            event.preventDefault();
        }
    });

    $(document).ready(function() {
        const checkbox = $('#confirmCheck');
        const trademarkFormSubmit = $('#submitRegistrationForm');
        trademarkFormSubmit.prop('disabled', !checkbox.is(':checked'));
        checkbox.on('change', function() {
            trademarkFormSubmit.prop('disabled', !this.checked);
        });
    });
</script>
{{-- main section end here --}}


{{-- onload initialized the hidden fields --}}
<script>
    $(window).on('load', function() {
        // Check if the elements are available and execute the function immediately
        const checkElements = setInterval(function() {
            const substatusElement = $('#sub-status').find(':selected');
            const statusElement = $('#status').find(':selected');

            if (substatusElement.length && statusElement.length) {
                const substatusSlug = substatusElement.data('slug');
                const slug = statusElement.data('slug');

                subStatusHearingDateExaminationReport(slug, substatusSlug);
                clearInterval(checkElements); // Stop the interval once the function is executed
            }
        }, 100); // Check every 100ms
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        // Function to handle status change
        $('#status').on('change', function(e) {
            e.preventDefault();
            const statusSlug = $(this).find(':selected').data(
                'slug'); // Fetch the data-slug of selected option
            if (statusSlug) {

                getOpptionsforStatus(statusSlug);
            }
        });

        // Function to handle opponent/applicant change
        $('#opp_app_name').on('change', function(e) {
            e.preventDefault();
            const statusSlug = $('#status').find(':selected').data('slug'); // Fetch slug from #status
            const getvalue = $(this).val(); // Fetch selected value
            if (getvalue && statusSlug) {
                getOpponentApplicantNameNumber(getvalue,
                    statusSlug); // Call function with value and slug
            }
        });


        $(document).on('change', '#sub-status', function() {
            const slug = $('#status').find(':selected').data('slug');
            const substatusSlug = $(this).find(':selected').data('slug');
            if (slug === 'objected') {
                subStatusHearingDateExaminationReport(slug, substatusSlug);
            }
        });

        // Onload initialization  

        (function initializeDropdowns() {
            const statusSlug = $('#status').find(':selected').data('slug');
            const getvalue = $('#opp_app_name').find(':selected').val();

            if (statusSlug) {
                getOpptionsforStatus(statusSlug);
            }

            if (getvalue && statusSlug) {
                getOpponentApplicantNameNumber(getvalue, statusSlug);
            }
        })();


    });
</script>
<script>
    $(document).ready(function() {
        $('#anotherOpposed').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you any other Opposed?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, I Have!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('registrationTrademarkForm');
                    form.action = "{{ route('admin.SaveDataForAnotherOpposedNumber') }}";
                    form.method = "POST";
                    form.submit();
                }
            });
        });
    });
</script>

{{-- onload initialized the hidden fields --}}
@endsection