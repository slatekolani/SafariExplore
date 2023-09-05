<table class="table table-hover table-responsive-md" id="system_users-table">
    <thead>
    <tr>
        <th>@lang('label.name')</th>
        <th>@lang('label.email')</th>
        <th>@lang('label.created_at')</th>
        <th>@lang('label.administrator.system.access_control.roles')</th>
        <th>@lang('label.status')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            $('#system_users-table').DataTable({
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

                ajax: '{{ route('admin.user_manage.get_system_users_for_dt') }}',
                columns: [
                    { data: 'username', name: 'username', orderable: true, searchable: true},
                    { data: 'email', name: 'email', orderable: true, searchable: true},
                    { data: 'created_date', name: 'created_date', orderable: true, searchable: true},
                    { data: 'role_label', name: 'role_label', orderable: false, searchable: false},
                    { data: 'active_status', name: 'active_status', orderable: false, searchable: false},
                    // { data: 'fullname', name: 'lastname', orderable: true, searchable: true, visible: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        document.location.href = url + "/admin/user_manage/edit_system_user/" + aData['uuid'] ;
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
