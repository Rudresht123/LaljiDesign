<div class="col-lg-6 mb-3 mb-md-0">
        <div class="custom-card">
            <div class="panel  m-0 p-0  panel-default">
                <div class="panel-heading border-bottom mb-2">
                    <h6 class="tx-14 m-0 p-0"><b class="d-flex"><i class="far fa-address-book me-1"></i> Attorneys Wise
                            Clients Summary</b></h6>
                </div>
                <div class="panel-body  pt-0">
                    <div class="row m-0 p-0">
                        <div id="class-section-attendance-absent-summary" class="col-lg-12 m-0 p-0"
                            style="max-height: 300px; min-height: 300px; overflow-y: scroll;">
                            <!-- class-section-attendance-absent-summary -->
                            <div class="row m-0 p-0">

                                @foreach ($attoernyes as $attoerny)
                                @php
                                $counter = 0;
                                @endphp
                                <div class="col-lg-12 p-2 cursor-pointer bg-light accordion-btn mt-1"
                                    onclick="toggleDetails(this)">

                                    <div class="row d-felx">
                                        <div class=" col-12 pl-4 d-flex justify-content-between">
                                            <b
                                                class="fs-10">{{ $attoerny->attorneys_name ? $attoerny->attorneys_name : '' }}</b>


                                            <span class="badge text-bg-danger"
                                                style="font-size: 8px;">{{ isset($datacount[$attoerny->id]) && $datacount[$attoerny->id] ? $datacount[$attoerny->id] : 0 }}</span>
                                        </div>

                                    </div>
                                    <!-- Ensure proper condition -->
                                    <div class="row m-0 p-0 mt-2 absent-data" style="display: none;">
                                        <input type="hidden" class="btn-action" value="close">
                                        <div class="col-lg-12 m-0 p-0">
                                            <table cellspacing="0" cellpadding="0"
                                                class="table tx-11 mt-1 m-0 p-0 bg-white table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-bold"><b>Application No.</b></th>
                                                        <th class="text-bold"><b>File Name</b></th>
                                                        <th class="text-bold"><b>Trademark Name</b></th>
                                                        <th class="text-bold"><b>Phone No.</b></th>
                                                        <th class="text-bold"><b>Status</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($groupedData as $groupdata)
                                                    @if ($attoerny->id === $groupdata->attorney_id)
                                                    @php
                                                    ++$counter;
                                                    @endphp
                                                    <tr class="fs-10">
                                                        <td>
                                                            <a
                                                                href="{{ route('admin.attorney.clientDetails', ['category_slug' => $groupdata->mainCategory->category_slug, 'id' => $groupdata->id]) }}">
                                                                {{ $groupdata->application_no ?? '' }}
                                                            </a>
                                                        </td>
                                                        <!-- Placeholder for profile image -->
                                                        <td>{{ $groupdata->file_name ?? '' }}</td>
                                                        <td style="word-wrap:nowrap;">
                                                            {{ $groupdata->trademark_name ?? '' }}
                                                        </td>
                                                        <td>{{ $groupdata->phone_no ?? '' }}</td>
                                                        <td>{{ $groupdata->statusMain->status_name ?? '' }}
                                                        </td>
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