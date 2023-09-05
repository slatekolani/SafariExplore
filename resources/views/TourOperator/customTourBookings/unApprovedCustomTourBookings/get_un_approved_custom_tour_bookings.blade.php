<table class="table table-hover table-responsive-md" id="custom_tour_bookings-table">
    <thead>
    <tr>
        <th>@lang('Booking Date and Time ')</th>
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
        <th>@lang('Approve/ Un-Approve Booking')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#custom_tour_bookings-table').DataTable({
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
                ajax: '{{ route('customTourBookings.getUnApprovedCustomTourBookings',$tourOperator->id) }}',
                columns: [
                    { data: 'booking_date_and_time', name: 'booking_date_and_time', orderable: true, searchable: true},
                    { data: 'company_booked', name: 'company_booked', orderable: true, searchable: true},
                    { data: 'tourist_name', name: 'tourist_name', orderable: true, searchable: true},
                    { data: 'tourist_email_address', name: 'tourist_email_address', orderable: true, searchable: false},
                    { data: 'tourist_phone_number', name: 'tourist_phone_number', orderable: true, searchable: false},
                    { data: 'tourDuration', name: 'tourDuration', orderable: true, searchable: false},
                    { data: 'countDownDaysForCustomTour', name: 'countDownDaysForCustomTour', orderable: true, searchable: false},
                    { data: 'start_date', name: 'start_date', orderable: true, searchable: true},
                    { data: 'end_date', name: 'end_date', orderable: true, searchable: true},
                    { data: 'isSafariExpired', name: 'isSafariExpired', orderable: true, searchable: false},
                    { data: 'tourist_visit_areas', name: 'tourist_visit_areas', orderable: true, searchable: true},
                    { data: 'tourist_country', name: 'tourist_country', orderable: false, searchable: true},
                    { data: 'total_adult_travellers', name: 'total_adult_travellers', orderable: true, searchable: false},
                    { data: 'total_children_travellers', name: 'total_children_travellers', orderable: false, searchable: false},
                    { data: 'message', name: 'message', orderable: false, searchable: true},
                    { data : "approve_or_un_approve_booking", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">

                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="approve_or_un_approve_booking" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="approve_or_un_approve_booking">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
                    { data: 'booking_status', name: 'booking_status', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        document.location.href = url + "/customTourBookings/view/" + aData['uuid'] ;
                    }).hover(function () {
                        $(this).css('cursor', 'pointer');
                    }, function () {
                        $(this).css('cursor', 'auto');
                    });
                }


            });
            $(document).on('click','#approve_or_un_approve_booking',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('customTourBookings.approveOrUnApproveBooking')}}',
                    data: {'status': status,'id':id},
                    success: function (data) {
                        // $('#notify').fadeIn();
                        // $('#notify').css('background','green');
                        // $('#notify').text('status updated successfully');
                        // // SetTimeout(()=>{
                        // //     $('#notify').fadeOut();
                        // // });
                    }
                })
            })
        });

    </script>

@endpush
