@include('admin_panel.comman.external-links')
@include('admin_panel.comman.header')

{{-- main section --}}
@yield('main-content')
{{-- main section --}}


@include('admin_panel.layouts.Models.AddModels') <!--add crud modal (popup)-->
@include('admin_panel.layouts.Models.EditModels') <!--edit crud modal (popup)-->

@include('admin_panel.comman.dashboardfooter')