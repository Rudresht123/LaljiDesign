<script type="text/javascript">
    $(document).ready(function(){
        setInterval(updateClock, 1000);
        updateClock();
    });
    </script>
    
<header class="navbar navbar-header navbar-header-fixed">
    <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
        <img src="{{ asset('assets/newimage/main-logo.png') }}" style="height:50px;width:auto;" alt="">
    </div><!-- navbar-brand -->
    <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
            <img src="{{ asset('assets/newimage/main-logo.png') }}" alt="">
            <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        <ul class="nav navbar-menu">
            <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
            <li class="nav-item active"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="package"></i> Module</a>

                <div class="navbar-menu-sub mx-wd-400">
                    <div class="row m-0 p-0">
                        @if(auth()->user()->hasPermission('admin.global-setting.attorneys'))
                        <a href="{{ route('admin.global-setting.attorneys') }}" class="col-lg-12 m-0 p-0 bd-1">
                            <ul>
                                
                                <li class="list-group-item d-flex align-items-center bd-0">
                                    <div class="mg-r-15 p-2 rounded-10 bg-light">
                                        <img src="{{ asset('assets/img/icons/atorney.png') }}" class="wd-30">
                                    </div>
                                    <div>
                                        <h6 class="tx-14 tx-inverse font-weight-normal tx-semibold mg-b-0">Define
                                            Attorney</h6>
                                        <span class="d-block tx-10 text-muted"
                                            style="line-height:1.2; margin-top:3px;  ">Attorney Registration, Edit ,Show
                                            and Delete</span>
                                    </div>
                                </li>
                            </ul>
                        </a>
                        @endif
                        @if(auth()->user()->hasPermission('admin.reports.clients-reports'))
                        <a href="{{ route('admin.reports.clients-reports') }}" class="col-lg-12 m-0 p-0 bd-1">
                            <ul>
                                <li class="list-group-item d-flex align-items-center bd-0">
                                    <div class="mg-r-15 p-2 rounded-10 bg-light">
                                        <img src="{{ asset('assets/img/icons/client.png') }}" class="wd-30">
                                    </div>
                                    <div>
                                        <h6 class="tx-14 tx-inverse font-weight-normal tx-semibold mg-b-0">Clients
                                            Reports</h6>
                                        <span class="d-block tx-10 text-muted"
                                            style="line-height:1.2; margin-top:3px;  ">Clients,Clients Reports</span>
                                    </div>
                                </li>
                            </ul>
                        </a>
                        @endif
                        @if(auth()->user()->hasPermission('admin.users-roles.users'))
                        <a href="{{ route('admin.users-roles.users') }}" class="col-lg-12 m-0 p-0 bd-1">
                            <ul>
                                <li class="list-group-item d-flex align-items-center bd-0">
                                    <div class="mg-r-15 p-2 rounded-10 bg-light">
                                        <img src="{{ asset('assets/img/icons/users.png') }}" class="wd-30">
                                    </div>
                                    <div>
                                        <h6 class="tx-14 tx-inverse font-weight-normal tx-semibold mg-b-0">Software Users</h6>
                                        <span class="d-block tx-10 text-muted"
                                            style="line-height:1.2; margin-top:3px;  ">Users Roles Permission Management</span>
                                    </div>
                                </li>
                            </ul>
                        </a>
                        @endif
                        @if(auth()->user()->hasPermission('admin.client-dpp-reports'))
                        <a href="{{ route('admin.client-dpp-reports') }}" class="col-lg-12 m-0 p-0 bd-1">
                            <ul>
                                <li class="list-group-item d-flex align-items-center bd-0">
                                    <div class="mg-r-15 p-2 rounded-10 bg-light">
                                        <img src="{{ asset('assets/img/icons/report_icon.png') }}" class="wd-30">
                                    </div>
                                    <div>
                                        <h6 class="tx-14 tx-inverse font-weight-normal tx-semibold mg-b-0">DPP Report</h6>
                                        <span class="d-block tx-10 text-muted"
                                            style="line-height:1.2; margin-top:3px;  ">Daily Production Performance Summary.</span>
                                    </div>
                                </li>
                            </ul>
                        </a>
                      @endif
                         </div>
                </div>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> Global Settings</a>
                <div class="navbar-menu-sub">
                    <div class="d-lg-flex">
                        <ul>
                            @if(auth()->user()->hasPermission('admin.global-setting.financialYear'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.financialYear') }}"
                                    class="a nav-sub-link"><i data-feather="settings"></i> Define Financial Year</a>
                            </li>
                            @endif
                            @if(auth()->user()->hasPermission('admin.global-setting.financialYear'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.main-category') }}"
                                    class="nav-sub-link"><i data-feather="file"></i> Define Category</a></li>
                                    
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global-setting.status'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.status') }}"
                                    class="nav-sub-link"><i data-feather="bar-chart"></i> Define Status</a></li>
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global_setting.office'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global_setting.office') }}"
                                    class="nav-sub-link"><i data-feather="home"></i> Define Office</a></li>
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global-setting.trademark-classes'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.trademark-classes') }}"
                                    class="nav-sub-link"><i data-feather="lock"></i> TradeMarkClasses</a></li>
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global-setting.remarks'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.remarks') }}"
                                    class="nav-sub-link"><i data-feather="layers"></i> Define Remarks</a></li>
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global-setting.client-remarks'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.client-remarks') }}"
                                    class="nav-sub-link"><i data-feather="file-text"></i>Define Client Whatsapp Remarks</a></li>
                                    @endif
                        </ul>
                        <ul>
                            @if(auth()->user()->hasPermission('admin.systemsetting.all-email-template'))
                            <li class="nav-sub-item"><a href="{{ route('admin.systemsetting.all-email-template') }}"
                                    class="nav-sub-link"><i data-feather="mail"></i> Email Templates</a></li>
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global-setting.pdf-template'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.pdf-template') }}"
                                    class="nav-sub-link"><i data-feather="file"></i> PDF Template</a></li>
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global-setting.consultant'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.consultant') }}"
                                    class="nav-sub-link"><i data-feather="users"></i> Consultants</a></li>
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global-setting.dealler'))
                            <li class="nav-sub-item"><a href="{{ route('admin.global-setting.dealler') }}"
                                    class="nav-sub-link"><i data-feather="users"></i> Deallers</a></li>
                                    @endif
                                    @if(auth()->user()->hasPermission('admin.global-setting.excelcolumn'))
                                    <li class="nav-sub-item"><a href="{{ route('admin.global-setting.excelcolumn') }}"
                                        class="nav-sub-link"><i data-feather="book-open"></i> Excel Column Name</a></li>
                                        @endif
                                        @if(auth()->user()->hasPermission('admin.user-roles.permission-group'))
                                        <li class="nav-sub-item"><a href="{{ route('admin.user-roles.permission-group') }}"
                                            class="nav-sub-link"><i data-feather="book-open"></i> Permission Group</a></li>
                                            @endif
                        </ul>
                    </div>
                </div><!-- nav-sub -->
            </li>
            <li hidden class="nav-item"><a href="../../components/" class="nav-link"><i data-feather="box"></i>
                    Components</a></li>
            <li hidden class="nav-item"><a href="../../collections/" class="nav-link"><i data-feather="archive"></i>
                    Collections</a></li>
        </ul>
    </div><!-- navbar-menu-wrapper -->
    <div class="navbar-right">
        @php
            use Illuminate\Support\Carbon;
        @endphp
        <div class="dropdown dropdown-notification pt-1">
            <a href="javascript:void(0);" role="button" class="dropdown-link   d-none d-md-block"
                data-bs-toggle="dropdown" data-bs-display="static">
                <ul style="list-style-type:none;line-height:1.4;" class="w-100 ">
                    <li class="fw-bold" style="font-size:8px;">Financial Year :
                        {{ Session::get('financial_session') }}</li>
                    <li class="fw-bold" style="font-size:8px;">Today : {{ Carbon::today()->format('d-m-Y') }} </li>
                    <li class="fw-bold" style="font-size:8px;">Time : <span class="text-danger" id="clock"></span></li>
                    <li style="font-size:8px;"><a class="fw-bold d-none d-md-block text-danger" href="" data-bs-toggle="modal"
                            data-bs-target="#changeSession"><i class="far fa-calendar-check"></i> Change</a></li>
                </ul>
            </a><!-- dropdown-link -->
        </div><!-- dropdown -->
        <div class="dropdown dropdown-profile">
            <a href="" role="button"  class="text-center  dropdown-link" data-bs-toggle="dropdown"
                data-bs-display="static">
                <div class="avatar avatar-sm">
                    <img src="{{ Auth::user()->user_image ? asset('storage/uploads/admins_images/'.Auth::user()->user_image) : asset('assets/newimage/user.png') }}" class="rounded-circle" alt="">
                </div>
                <span class="tx-semibold d-none d-md-block fw-bold text-dark fs-10 m-1 nowrap  mg-b-5">{{ Auth::user()->name ? Auth::user()->name : '' }}</span>
            </a><!-- dropdown-link -->
            <div class="dropdown-menu dropdown-menu-end">
                <div class="avatar avatar-lg mg-b-15">  <img src="{{ Auth::user()->user_image ? asset('storage/uploads/admins_images/'.Auth::user()->user_image) : asset('assets/newimage/user.png') }}" class="rounded-circle" alt="">
                </div>
                <h6 class="tx-semibold mg-b-5 ">{{ Auth::user()->name ? Auth::user()->name : '' }}</h6>
                <p class="mg-b-25 tx-12 tx-color-03">{{Auth::user()->role}}</p>


                <a id="sign_out" href="" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
            </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
    </div><!-- navbar-right -->
    <div class="navbar-search">
        <div class="navbar-search-header">
            <input type="search" class="form-control" placeholder="Type and hit enter to search...">
            <button class="btn"><i data-feather="search"></i></button>
            <a id="navbarSearchClose" href="" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
        </div><!-- navbar-search-header -->
        <div class="navbar-search-body">
            <label
                class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recent
                Searches</label>
            <ul class="list-unstyled">
                <li><a href="dashboard-one.html">modern dashboard</a></li>
                <li><a href="app-calendar.html">calendar app</a></li>
                <li><a href="../../collections/modal.html">modal examples</a></li>
                <li><a href="../../components/el-avatar.html">avatar</a></li>
            </ul>

            <hr class="mg-y-30 bd-0">

            <label
                class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Search
                Suggestions</label>

            <ul class="list-unstyled">
                <li><a href="dashboard-one.html">cryptocurrency</a></li>
                <li><a href="app-calendar.html">button groups</a></li>
                <li><a href="../../collections/modal.html">form elements</a></li>
                <li><a href="../../components/el-avatar.html">contact app</a></li>
            </ul>
        </div><!-- navbar-search-body -->
    </div><!-- navbar-search -->
</header><!-- navbar -->

<body
    style=" background: linear-gradient(rgba(245, 247, 250, .65), rgba(245, 247, 250, .65)), url({{ asset('assets/newimage/bg-app.jpg') }}); background-size: 50%; "
    onload="display_ct();">
    <div class=" content-fixed">
        <div class="container-fluid p-2 p-md-3 m-0 p-0">

{{-- spinner --}}
<!--<div id="spinner-loader" class="spinner-border" role="status">-->
<!--    <span class="sr-only">Loading...</span>-->
<!--  </div>-->
  {{--spinner  --}}
            {{-- loader section start here --}}
            <div id="overlay"></div>
            <div id="ld" class="ld text-center" style="display: none;">
                <span class="loader"></span>
                <p style="font-size: 16px;" class="text-light fw-bold">Plase Wait...</p>
            </div>
            {{-- loader section start here --}}
