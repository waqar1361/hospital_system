@extends("layouts.app")
@section('page-title','Patients')
@section('page-description','List of all Patients')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>Patients</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                    <li><i class="fa fa-window-maximize full-card"></i></li>
                    <li><i class="fa fa-minus minimize-card"></i></li>
                    <li><i class="fa fa-refresh reload-card"></i></li>
                    <li><i class="fa fa-trash close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover" id="patients-table">
                    <thead class="thead-light">
                    <tr>
                        <th>MRN</th>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Room</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>

        $(document).ready(function () {

            $('#patients-table thead tr').clone(true).appendTo('#patients-table thead');
            $('#patients-table thead tr:eq(1) th').each(function (i) {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });

            var table = $('#patients-table').DataTable({
                data: {!! $patients !!},
                columns: [
                    {data: 'mrn'},
                    {
                        data: null,
                        "render": function (data, type, row) {
                            let name = (data["first_name"] + " " + data["last_name"]);
                            return '<a class="btn-link" href="patients/' + data['id'] + '/visits">' + name + '</a>';
                        }

                    },
                    {data: 'sex'},
                    {data: 'email'},
                    {data: 'contact_number'},
                    {
                        data: null,
                        render: function (data) {
                            if (data['visit'])
                                return (data["visit"]['room']);
                            else
                                return "No visits"
                        }
                    },
                    {
                        data: null,
                        render: function (data) {
                            if (data['visit'])
                                return (data["visit"]['status']);
                            else
                                return "No visits"
                        }
                    },
                    {
                        data: null,
                        render: function (data) {
                            let html = "";
                            if (data['visit'] == null) {
                                html += '<a href="/public/patients/' + data['id'] + '/visits/create" class="btn btn-round btn-info" ' +
                                    'title="Create visit" data-toggle="tooltip">' +
                                    '<i class="fa fa-car"></i></a>';
                            } else {
                                if (data['visit']['status'] == 'discharged') {
                                    html += '<a href="/public/patients/' + data['id'] + '/visits/create" class="btn btn-round btn-info" ' +
                                        'title="Re-admit" data-toggle="tooltip">' +
                                        '<i class="fa fa-sync"></i></a>';
                                }

                                html += '<a href="/public/visits/' + data['visit']['id'] + '/details" class="btn btn-round btn-info"' +
                                    'title="Visit Details" data-toggle="tooltip"><i class="fa fa-list-alt"></i></a>';
                            }

                            html += '<a href="/public/patients/' + data["id"] + '" class="btn btn-round btn-info"' +
                                'title="Edit" data-toggle="tooltip"><i class="fa ' +
                                'fa-pencil"></i></a>';
                            html += '<a href="/public/patients/' + data["id"] + '" class="btn btn-round btn-danger ajax-delete"' +
                                'title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>';
                            // if (data['visit'])
                            // {
                            //     html += '<a href="/public/visits/' + data['visit']['id'] + '/details" class="btn btn-round btn-info"' +
                            //         'title="Visit Details" data-toggle="tooltip"><i class="fa fa-list-alt"></i></a>';
                            // }
                            return html;
                        }
                    }

                ],
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'],
                orderCellsTop: true,
                fixedHeader: true
            });
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });
    </script>
@endsection
