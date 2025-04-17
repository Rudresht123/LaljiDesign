<div class="col-sm-6 mb-3"> <!-- Added mb-3 to give margin bottom -->
      <div class="custom-card">
        <div class="panel m-0 p-0  panel-default">
          <div class="panel-heading border-bottom mb-2">
            <h6 class="tx-14 m-0 pb-2 d-flex justify-content-between" style="padding-right: 40px !important;">
              <b class="fs-12">
                Total CopyRight
              </b>
              <b class="fs-12 mx-end"><span class="badge text-bg-success  fs-10 px-3">{{$copyRighttotalCount ?? ''}}</span></b>
            </h6>
          </div>
          <div class="panel-body pt-0">
            <table class="table  table-bordered table-hover fs-10">
              <thead class="bg-light">
                <tr>
                  <th class="fw-bold text-center">Sr.</th>
                  <th class="fw-bold text-center">Status</th>
                  <th class="fw-bold text-center">Count</th>
                </tr>
              </thead>
              <tbody>
                @php
                $count=0;
                @endphp
                @foreach ($copyrightstatuswisecount as $copyrightclientCount)
                <tr>
                  <td class="text-center">{{++$count}}</td>
                  <td class="fs-12">{{$copyrightclientCount->status_name ?? ''}}</td>
                  <td class="text-center">
                    <span class="fs-10">
                      <a class="text-primary"
                        href="{{ auth()->user()->hasPermission('admin.attorney.chart.status-data') ? route('admin.attorney.chart.status-data', [
                                       'attorney_id' => $attorney->id, 
                                       'category_slug' => 'copyright', 
                                       'status_id' => $copyrightclientCount->id
                                   ]) : 'javascript:void(0)' }}">
                        {{ $copyrightclientCount->usercount ?? '' }}
                      </a>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>