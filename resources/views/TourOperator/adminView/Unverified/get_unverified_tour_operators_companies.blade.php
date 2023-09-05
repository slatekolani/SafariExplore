<table class="table table-hover table-responsive-md" id="unverified_tour_operators_companies-admin-table">
    <thead>
    <tr>
        <th>@lang('Company logo')</th>
        <th>@lang('Company name')</th>
        <th>@lang('Email address')</th>
        <th>@lang('Phone number')</th>
        <th>@lang('Company nation')</th>
        <th>@lang('About company')</th>
        <th>@lang('Website Url')</th>
        <th>@lang('GPS Url')</th>
        <th>@lang('Instagram Url')</th>
        <th>@lang('WhatsApp Url')</th>
        <th>@lang('Activate/Deactivate Company')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table=$('#unverified_tour_operators_companies-admin-table').DataTable({
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

                ajax: '{{ route('tourOperatorCompaniesManagement.getUnverifiedTourOperatorsCompanies') }}',
                columns: [
                    {
                        "render": function (data,type,row) {
                            return`
                    ${'<img src="'+row.company_logo+'" class="avatar" width="50" height="50" style="border-radius:50%"/>'}
            `
                        },
                    },
                    { data: 'company_name', name: 'company_name', orderable: true, searchable: true},
                    { data: 'email_address', name: 'email_address', orderable: true, searchable: true},
                    { data: 'phone_number', name: 'phone_number', orderable: true, searchable: false},
                    { data: 'company_nation', name: 'company_nation', orderable: false, searchable: false},
                    { data: 'about_company', name: 'about_company', orderable: true, searchable: false},
                    { data: 'website_url', name: 'website_url', orderable: false, searchable: false},
                    { data: 'gps_url', name: 'gps_url', orderable: false, searchable: false},
                    { data: 'instagram_url', name: 'instagram_url', orderable: false, searchable: false},
                    { data: 'whatsapp_url', name: 'whatsapp_url', orderable: false, searchable: false},
                    { data : "activate_or_deactivate_company", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">

                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="activate_or_deactivate_company" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="activate_or_deactivate_company">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
                    { data: 'company_status', name: 'company_status', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        // document.location.href = url + "/tourOperator/edit/" + aData['uuid'] ;
                    }).hover(function () {
                        $(this).css('cursor', 'pointer');
                    }, function () {
                        $(this).css('cursor', 'auto');
                    });
                }


            });
            $(document).on('click','#activate_or_deactivate_company',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('tourOperatorCompaniesManagement.ActivateOrDeactivateCompany')}}',
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
