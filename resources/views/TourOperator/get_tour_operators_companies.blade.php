<table class="table table-hover table-responsive-md" id="tour_operators_companies-table" style="background-color: rgba(255,255,255,0.6);color: black">
    <thead>
    <tr>
        <th>@lang('#')</th>
        <th>@lang('Registration Date')</th>
        <th>@lang('Deleted Date')</th>
        <th>@lang('Company name')</th>
        <th>@lang('Email address')</th>
        <th>@lang('Phone number')</th>
        <th>@lang('Company nation')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            $('#tour_operators_companies-table').DataTable({
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

                ajax: '{{ route('tourOperator.getTourOperatorCompanies') }}',
                columns: [
                    { data: 'id', name: 'id', orderable: true, searchable: true},
                    { data: 'registrationDate', name: 'registrationDate', orderable: true, searchable: true},
                    { data: 'deletedDate', name: 'deletedDate', orderable: true, searchable: true},
                    { data: 'company_name', name: 'company_name', orderable: true, searchable: true},
                    { data: 'email_address', name: 'email_address', orderable: true, searchable: true},
                    { data: 'phone_number', name: 'phone_number', orderable: true, searchable: false},
                    { data: 'company_nation', name: 'company_nation', orderable: false, searchable: false},
                    { data: 'status', name: 'status', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        document.location.href = url + "/tourOperator/show/" + aData['uuid'] ;
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
