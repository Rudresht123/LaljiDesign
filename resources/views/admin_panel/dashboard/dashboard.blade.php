{{-- extending master layout here --}}
@extends('admin_panel.comman.masterLayout')
{{-- extending master layout here --}}


{{-- main content section start here --}}
@section('main-content')
<style>
    #chartBar1 {
        height: 350px !important;
    }

    #chartBar2 {
        max-height: 200px;
    }

    .nowrap {
        white-space: nowrap !important;
    }
</style>

<!-- attorneys section -->
 <!-- client Summary -->
 @include('admin_panel.dashboard.summerytemplate.attorneys')


 <div class="row d-flex mt-3" style="box-sizing:border-box;">
   
<!-- client Summary -->
 @include('admin_panel.dashboard.summerytemplate.client-summery-attorneywise')

{{-- report section --}}

@include('admin_panel.dashboard.summerytemplate.upcommingdate-data')
 </div>
{{-- report section end here --}}



{{-- /chart section start here --}}
<div class="row mt-3 d-flex" style="box-sizing:border-box;">
    <!-- First Column -->
    <div class="col-sm-12 mb-3"> <!-- Added mb-3 to give margin bottom -->
        <div class="custom-card">
            <div class="panel m-0 p-0  panel-default">
                <div class="panel-heading border-bottom mb-2">
                    <h6 class="tx-14 m-0 p-0">
                        <b class="d-flex">
                            <i class="far fa-address-book me-1"></i> Category Vise Clients Summary
                        </b>
                    </h6>
                </div>
                <div class="panel-body pt-0" style="overflow-x: auto; white-space: nowrap;width:100%;">
                    <canvas id="chartBar2" class="chart_canvas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Column -->
    <div class="col-sm-12 mb-3">
        <div class="custom-card"><!-- Added mb-3 to give margin bottom -->
            <div class="panel m-0 p-0  panel-default">
                <div class="panel-heading border-bottom mb-2">
                    <h6 class="tx-14 m-0 p-0">
                        <b class="d-flex">
                            <i class="far fa-address-book me-1"></i> Status Vise Clients Summary
                        </b>
                    </h6>
                </div>
                <div class="panel-body pt-0">
                    <canvas id="chartBar1" class="chart_canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- chart section end here --}}

<!-- code for the chart start here -->

{{-- modal code for update status --}}
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Client Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSubstatusFormForClients" method="POST">
                    @csrf
                    <fieldset class="form-fieldset">
                        <legend id="clientFileName">Update Status</legend>
                        <div class="form-group">
                            <label for="" class="form-label">ClientId</label>
                            <input type="text" readonly name="clientId" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Main Category Slug</label>
                            <input type="text" readonly name="main_category_slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Category</label>
                            <select name="updateStatusMainCategory" id="" class="form-select">
                                @foreach ($mcategories as $mcat)
                                <option value="{{ $mcat->id }}">{{ $mcat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Categry Status</label>
                            <select name="clientstatus" id="" class="form-select">
                                @foreach ($subcategory as $subcat)
                                <option value="{{ $subcat->id }}">{{ $subcat->subcategory }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- edit status modal end here --}}






{{-- edit status modal open code here with data --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#renuwalTable').on('click', '.editStatus', function(e) {
            e.preventDefault();

            // Get client ID, category ID, and category slug from data attributes
            let clientId = $(this).data('id');
            let cattId = $(this).data('category-id');
            let category_slug = $(this).data('category-slug');

            // Prepare form data as an object
            let formData = {
                clientId: clientId,
                categoryId: cattId,
                categorySlug: category_slug,
                _token: "{{ csrf_token() }}" // Include CSRF token for security
            };

            console.log(formData); // Check if data is being prepared correctly

            // Get the route URL using Laravel's route helper
            let route = "{{ route('admin.getClientDataForUpdate') }}";

            // Make AJAX POST request
            $.ajax({
                url: route,
                type: "POST",
                data: formData,
                success: function(response) {
                    console.log(response); // Log the entire response to see its structure

                    // Check if clientDetails exists in the response
                    if (response.clientDetails) {
                        // Set form values based on response
                        $('input[name="clientId"]').val(response.clientDetails.id);
                        $('input[name="main_category_slug"]').val(category_slug);

                        $('select[name="updateStatusMainCategory"]').val(response
                            .clientDetails.category_id);
                        if (response.clientDetails.sub_category) {
                            $('select[name="clientstatus"]').val(response.clientDetails
                                .sub_category);
                        }
                        $('#clientFileName').text(response.clientDetails.file_name)
                        $('#editStatusModal').modal(
                            'show'); // Show modal after populating the form
                    } else {
                        console.error('Unexpected response structure:', response);
                    }
                },
                error: function(xhr) {
                    $('#ld').hide(); // Hide loader on error
                    $('#overlay').hide(); // Hide overlay on error
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '<ul>'; // Start the unordered list
                        for (const field in errors) {
                            errorMessages += '<li>' + errors[field][0] +
                                '</li>'; // Show first error message for each field
                        }
                        errorMessages += '</ul>'; // Close the unordered list
                        Swal.fire({
                            title: 'Validation Errors',
                            html: errorMessages, // Display errors as a list
                            icon: 'error',
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'Okay'
                        });
                        console.error(xhr); // Optional: Log the error for debugging
                    }
                }
            });
        });
    });
</script>


<!-- chart javascript start here -->
<script type="text/javascript">
    $(document).ready(function() {
        let route = "{{ route('admin.chart.CategoryWiseUserCount') }}";
        horizontalchartBarFunction(route);
    });
    $(document).ready(function() {
        let route = "{{ route('admin.chart.statusWiseClientChart') }}";
        verticalBarChartFunction(route);
    });
</script>

<!-- chart javascript start here -->


{{-- script for the get search client for the dashbord --}}
<script type="text/javascript">
    $(document).ready(function() {
        let route = "{{ route('get.searchClent') }}";
        let csrfToken = "{{ csrf_token() }}";

        // Call the function to initialize Typeahead
        searchClientWithType(route, csrfToken);
    });
</script>

{{-- script for the get search client for the dashbord --}}

<script>
    function toggleDetails(element) {
        const details = element.querySelectorAll('.absent-data');
        details.forEach(detail => {
            detail.style.display = detail.style.display === 'none' ? 'block' : 'none';
        });
    }
</script>

<style>
    .accordion-btn {
        border: 1px solid silver;
    }

    .table-small tr th {
        border: 0px !important;
    }

    .table-small tr td,
    .table-small tr th {
        padding-left: 3px !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('.getExcel').on('click', function(e) {
            e.preventDefault();
            let route = $(this).data('url');
            if (route === 'javascript:void(0)') {
                alert("No data available for download.");
                return;
            }
            downloadexcel(route, 'GET')


        });

    });
</script>
<!-- content -->
@endsection
{{-- main content section start here --}}