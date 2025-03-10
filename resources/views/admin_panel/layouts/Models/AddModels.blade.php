
<div class="modal fade" id="addModelsData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog @hasSection('ModelSize') @yield('ModelSize') @else modal-lg wd-sm-750 @endif modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20 bg-light mb-3">
       
                <a href="#" class="close pos-absolute t-15 r-15" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-plus fa-lg"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-20 tx-sm-15 mg-b-1"><b>@yield('ModelTitle')</b></h4>
                        <p class="tx-10 tx-color-03 mg-b-0">@yield('ModelTitleInfo')</p>
                    </div>
                </div><!-- media -->
            </div><!-- modal-header -->

                @yield('AddModelPage')

        </div><!-- modal-content -->
        
    </div><!-- modal-dialog -->
</div><!-- modal -->
