<table class="table table-hover table-responsive-md" id="deleted_tour_packages-table" style="background-color: rgba(255,255,255,0.6);color: black">
    <thead>
    <tr>
        <th>@lang('#')</th>
        <th>@lang('Posted Time')</th>
        <th>@lang('Company Posted')</th>
        <th>@lang('Countdown Days')</th>
        <th>@lang('Is Expired?')</th>
        <th>@lang('Main Safari Name')</th>
        <th>@lang('Safari Start Date')</th>
        <th>@lang('Safari End Date')</th>
        <th>@lang('Active or Deactivate')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            $('#deleted_tour_packages-table').DataTable({
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

                ajax: '{{ route('tourPackages.getDeletedTourPackages',$tourOperator->id) }}',
                columns: [
                    { data: 'id', name: 'id', orderable: true, searchable: true},
                    { data: 'tourPackagePostedTime', name: 'tourPackagePostedTime', orderable: true, searchable: false},
                    { data: 'companyPostedTourPackage', name: 'companyPostedTourPackage', orderable: true, searchable: false},
                    { data: 'tourPackageCountDownDays', name: 'tourPackageCountDownDays', orderable: true, searchable: false},
                    { data: 'tourPackageExpired', name: 'tourPackageExpired', orderable: true, searchable: false},
                    { data: 'main_safari_name', name: 'main_safari_name', orderable: true, searchable: true},
                    { data: 'safari_start_date', name: 'safari_start_date', orderable: false, searchable: false},
                    { data: 'safari_end_date', name: 'safari_end_date', orderable: false, searchable: false},
                    { data: 'tourPackageStatus', name: 'tourPackageStatus', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        document.location.href = url + "/tourPackages/show/" + aData['uuid'] ;
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
