<div class="col-lg-6">
    <div class="custom-card">
        <div class="panel m-0 p-0  panel-default">
            <div class="panel-heading  border-bottom mb-2">
                <h6 class="tx-14 m-0 p-0"><b class="d-flex"><i class="far fa-address-book me-1"></i>Trademark Upcoming
                        Last Date</b></h6>
            </div>
            <div class="panel-body  pt-0">
                <div class="row m-0 p-0">
                    <div id="class-section-attendance-absent-summary" class="col-lg-12 m-0 p-0"
                        style="max-height: 300px; min-height: 300px; overflow-y: scroll;">
                        <!-- class-section-attendance-absent-summary -->
                        <div class="row m-0 p-0">
                            @php
                            $elementKey="";
                            @endphp
                            @foreach ($copyrightupcommingdates as $key=>$upcommingdate)
                            @php
                            $counter=0;
                            $elementKey=$key;

                            $ids= $copyrightupcommingdates[$key]->pluck('id')->toArray();
                            @endphp
                            <div class="col-lg-12 p-1 cursor-pointer bg-light accordion-btn mt-1"
                                onclick="toggleDetails(this)">
                                <div class="row p-1 ">
                                    <div class="col-12 pl-4 d-flex justify-content-between">
                                        <b class="fs-10">{{ $key ?? '' }}</b>
                                        <a style="cursor: pointer;" class="getExcel" data-url="{{ (!empty($ids) && is_iterable($ids) && count($ids) > 0) ? route('upcomingdatesexcel', ['category' => 'copyright', 'ids' => implode(',', $ids)]) : 'javascript:void(0)' }}">
                                            <span class="badge text-bg-danger">
                                                {{ is_iterable($upcommingdate) ? count($upcommingdate) : 0 }}
                                            </span>
                                        </a>

                                    </div>
                                    <div class="col-3 text-center">
                                        <!-- Assuming 'students' is the relationship -->
                                    </div>
                                </div>
                                <!-- Ensure proper condition -->
                                <div class="row m-0 p-0 mt-2 absent-data" style="display: none;">
                                    <input type="hidden" class="btn-action" value="close">
                                    <div class="col-lg-12 m-0 p-0">
                                        <table cellspacing="0" cellpadding="0"
                                            class="table tx-11 mt-1 m-0 p-0 bg-white table-bordered">
                                            <thead  style="background-color: #e6f0ff;">
                                                <tr>
                                                    <th class="text-bold nowrap"><b>Application No.</b></th>
                                                    <th class="text-bold nowrap"><b>File Name</b></th>
                                                    <th class="text-bold nowrap"><b>Status</b></th>
                                                    @if($key=='Valid UpTo')
                                                    <th class="text-bold nowrap"><b>Valid Upto</b></th>
                                                    @elseif($key=='Opposition Hearing Date')
                                                    <th class="text-bold nowrap"><b>Opposition Hearing Date</b></th>
                                                    @elseif($key=='Evidence Last Date')
                                                    <th class="text-bold nowrap"><b>Evidence Last Date</b></th>
                                                    @else
                                                    <th class="text-bold nowrap"><b>Hearing Date</b></th>
                                                    @endif

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($upcommingdate as $upcomming)
                                                @if ($key === $elementKey)
                                                @php
                                                ++$counter;
                                                @endphp
                                                <tr class="fs-10">
                                                    <td class="nowrap">
                                                        <a href="{{ route('admin.attorney.clientDetails', ['category_slug' => $copyrightgroupedData[0]->mainCategory->category_slug, 'id' => $upcomming->id]) }}">
                                                            {{ $upcomming->application_no  ?? ''}}
                                                        </a>
                                                    </td>
                                                    <!-- Placeholder for profile image -->
                                                    <td class="nowrap">{{ $upcomming->file_name ?? '' }}</td>
                                                    <td class="nowrap">{{ $upcomming->statusMain->status_name ?? '' }}</td>
                                                    @if($key=='Valid UpTo')
                                                    <td class="nowrap">{{ $upcomming->valid_up_to ?? '' }}</td>
                                                    @elseif($key=='Opposition Hearing Date')
                                                    <td class="nowrap">{{ $upcomming->opposition_hearing_date ?? '' }}</td>
                                                    @elseif($key=='Evidence Last Date')
                                                    <td class="nowrap">{{ $upcomming->evidence_last_date ?? '' }}</td>
                                                    @else
                                                    <td class="nowrap">{{ $upcomming->hearing_date ?? '' }}</td>
                                                    @endif
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>


                                        </table>

                                    </div>

                                </div>


                            </div>

                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>