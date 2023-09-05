<table class="table table-hover table-responsive-md" id="deleted_tour_bookings-table">
    <thead>
    <tr>
        <th>@lang('Deleted Date and Time ')</th>
        <th>@lang('Company Booked')</th>
        <th>@lang('Tourist name')</th>
        <th>@lang('Email address')</th>
        <th>@lang('Phone Number')</th>
        <th>@lang('Tour Duration (Days)')</th>
        <th>@lang('Countdown Days')</th>
        <th>@lang('Start Date')</th>
        <th>@lang('End Date')</th>
        <th>@lang('Is Expired?')</th>
        <th>@lang('Visit Places')</th>
        <th>@lang('Tourist Nation')</th>
        <th>@lang('Total adult travellers')</th>
        <th>@lang('Total children travellers')</th>
        <th>@lang('Message')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
             $('#deleted_tour_bookings-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },
                ajax: '{{ route('customTourBookings.getDeletedRecords',$tourOperator->id) }}',
                columns: [
                    { data: 'deleted_at', name: 'deleted_at', orderable: true, searchable: true},
                    { data: 'company_booked', name: 'company_booked', orderable: true, searchable: true},
                    { data: 'tourist_name', name: 'tourist_name', orderable: true, searchable: true},
                    { data: 'tourist_email_address', name: 'tourist_email_address', orderable: true, searchable: false},
                    { data: 'tourist_phone_number', name: 'tourist_phone_number', orderable: true, searchable: false},
                    { data: 'DeletedCustomTourDurationLabel', name: 'DeletedCustomTourDurationLabel', orderable: true, searchable: false},
                    { data: 'CountDownDaysForADeletedCustomTourLabel', name: 'CountDownDaysForADeletedCustomTourLabel', orderable: true, searchable: false},
                    { data: 'start_date', name: 'start_date', orderable: true, searchable: true},
                    { data: 'end_date', name: 'end_date', orderable: true, searchable: true},
                    { data: 'isDeletedSafariExpired', name: 'isDeletedSafariExpired', orderable: true, searchable: false},
                    { data: 'tourist_visit_areas', name: 'tourist_visit_areas', orderable: true, searchable: true},
                    { data: 'tourist_country', name: 'tourist_country', orderable: false, searchable: true},
                    { data: 'total_adult_travellers', name: 'total_adult_travellers', orderable: true, searchable: false},
                    { data: 'total_children_travellers', name: 'total_children_travellers', orderable: false, searchable: false},
                    { data: 'message', name: 'message', orderable: false, searchable: true},
                    { data: 'booking_status', name: 'booking_status', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        // document.location.href = url + "/customTourBookings/view/" + aData['uuid'] ;
                    }).hover(function () {
                        $(this).css('cursor', 'pointer');
                    }, function () {
                        $(this).css('cursor', 'auto');
                    });
                }


            });
        });

    </script>

@endpush
