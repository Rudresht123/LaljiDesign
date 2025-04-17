<!-- Extending master layout here -->
@extends('admin_panel.comman.masterLayout')
<!-- Extending master layout here -->


@section('main-content')
{{-- main section start here --}}

<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1 mg-b-10">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page">Global Setting</li>
    <li class="breadcrumb-item" aria-current="page">Attorney Category</li>
    <li class="breadcrumb-item active" aria-current="page">{{$attorney->attorneys_name ?? ''}}</li>
  </ol>
</nav>

{{-- category section start here --}}
<div class="container-fluid">
  <div class="row row-xs text-center">
    @foreach ($mainCategory as $category)
    @if(auth()->user()->hasPermission($category->category_slug))
    <div class="col-sm-12 col-lg-4 m-2 m-md-0 text-center">
      <a href="{{route('admin.attorney.user-registration',['attoernyId' => $attorney->id, 'category' => $category->category_slug])}}">
        <div class="atorney-card card card-body p-3 mb-2">
          <div class="d-flex align-items-center">
            <img src="{{ $category->category_icon ? asset('storage/uploads/category_icon/' . $category->category_icon) : asset('assets/img/icons/ipicon.png') }}"
              style="height:50px;width:50px;"
              class="border me-1 rounded-50"
              alt="Category Icon"> <span class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 fw-bold fs-5 text-dark">{{ ucwords($category->category_name)}}</span>
          </div>
        </div>
      </a>
    </div>
    @endif
    @endforeach
  </div>
</div>
{{-- category section start here --}}

{{-- /chart section start here --}}
<div class="container-fluid mt-4">
  <div class="row">

    <!-- trademark -->
    @include('admin_panel.users.IformationsofClients.trademarkclients')
    <!-- trademark -->

    <!-- category wise chart -->
    @include('admin_panel.users.IformationsofClients.categorywiseclientchart')
    <!-- category wise chart -->


    <!-- copyright -->
    @include('admin_panel.users.IformationsofClients.copyrightclients')
    <!-- copyright -->


  </div>
</div>
{{-- /chart section start here --}}


{{-- main section end here --}}


<script type="text/javascript">
  $(document).ready(function() {
    let route = "{{ route('admin.chart.perticularattoernywiseChart', $attorney->id) }}";

    pieChartBarFunction(route);
  });
</script>
@endsection