<div class="container-fluid pd-x-0 pd-lg-x-10 pd-xl-x-0">
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Attorney Dashboard</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
        </div>
        <div class="d-none d-md-flex col-sm-8  align-items-center justify-content-end">
            <form action="{{ route('get.searchClent-detail-dashboard') }}" method="POST" class="d-flex w-100">
                @csrf
                <div class="form-group mb-0 w-75">
                    <div class="search-form">
                        <input hidden id="client_id" name="client_id" type="text" class="form-control" placeholder="Search here...">
                        <input hidden id="category_id" name="category_id" type="text" class="form-control" placeholder="Search here...">
                        <input id="search-box" type="text" class="form-control" placeholder="Search here...">
                        <button class="btn" type="submit"><i data-feather="search"></i></button>
                    </div>
                </div>
            </form>
            <a href="{{ auth()->user()->hasPermission('admin.reports.clients-reports') ? route('admin.reports.clients-reports') : 'javascript:void(0);' }}"
                class="btn btn-sm pd-x-15 btn-primary btn-uppercase w-25 ms-2">

                <i data-feather="file" class="wd-10 me-1"></i> Generate Report
            </a>
        </div>


    </div>

    <div class="row row-xs">
        @foreach ($attoernyes as $attoerny)
        @if(auth()->user()->hasPermission($attoerny->id))
        <div class="col-sm-6 col-lg-4 mb-2">
            <a href="{{ route('admin.attorney.show-category', $attoerny->id) }}">
                <div class="atorney-card card card-body">
                    <div class="d-flex align-items-center">
                        @if ($attoerny->gender === 'Male')
                        <img src="{{ asset('assets/img/icons/atorney.png') }}"
                            class="border rounded-50 p-1 me-2" style="height:50px;width:50px;" alt="not found">
                        @else
                        <img src="{{ asset('assets/img/icons/f_attorney.png') }}"
                            class="border rounded-50 p-1 me-2" style="height:50px;width:50px;" alt="not found">
                        @endif
                        <span
                            class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 fw-bold fs-6 text-dark">{{ ucwords($attoerny->attorneys_name) }}</span>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @endforeach
    </div><!-- container-fluid -->

</div>