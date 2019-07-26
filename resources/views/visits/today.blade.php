<table class="table table-hover" id="visit-table">
    <thead>
    <tr>
        <th>MRN</th>
        <th>Date/Time</th>
        <th>Patient</th>
        <th>Sex</th>
        <th>Room</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>

</table>


@section('page-script')
    <script>
        $(document).ready(function () {
            $('#visit-table').DataTable({
                data: {!! $visits !!},
                columns: [
                    {
                        data: 'patient',
                        render: function (data) {
                            return data["mrn"];
                        }
                    },
                    {data: 'time'},
                    {
                        data: 'patient',
                        render: function (data) {
                            return data['first_name'] + " " + data["last_name"];
                        }
                    },
                    {
                        data: 'patient',
                        render: function (data) {
                            return data["sex"];
                        }
                    },
                    {data: 'room'},
                    {data: 'status'},
                    {
                        data: null,
                        render: function (data) {
                            let html = "";
                            if (data['status'] == "waiting") {
                                html += '<a href="/visits/' + data['id'] + '/vitalSign/create" class="btn btn-round btn-info"' +
                                    ' title="Capture Vitals" data-toggle="tooltip"><i class="fa fa-user-md"></i></a>';
                            }
                            
                            if (data['status'] == "ready" || data['signed'] == false) {
                                html += '<a href="/visits/' + data['id'] + '/notes/create" class="btn btn-round btn-info"' +
                                    ' title="Attend Patient" data-toggle="tooltip"><i class="fa fa-stethoscope"></i></a>';
                            }

                            if (data['status'] == "ready_to_discharge" ) {
                                html += '<a href="/visits/' + data['id'] + '/edit" class="btn btn-round btn-info"' +
                                    ' title="Attend Patient" data-toggle="tooltip"><i class="fa fa-stethoscope"></i></a>';
                            }

                            if (data['status'] == "bill_payed") {
                                html += '<a href="/visits/' + data['id'] + '/discharge" class="btn btn-round btn-info ' +
                                    'discharge"' +
                                    ' title="Discharge Patient" data-toggle="tooltip"><i class="fa fa-sign-out"></i></a>';
                            }
                            
                            if (data['status'] == "discharged") {
                                html += '<a href="/visits/' + data["id"] + '/details" class="btn btn-round btn-info"' +
                                    ' title="Details" data-toggle="tooltip"><i class="fa fa-list-alt"></i></a>';
                            }
                            
                            return html;
                        }
                    }
                
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5']
            });
            
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>
@endsection






