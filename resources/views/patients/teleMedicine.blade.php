@extends("layouts.app")
@section('page-title','Patients')
@section('page-description','List of all Tele Medicine Patients')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>Tele Med Patients</h5>
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
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>MRN</th>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Email</th>
                        <th>Contact</th>
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
            $('.table').DataTable({
                data: {!! $patients !!},
                columns: [
                    {data: 'mrn'},
                    {
                        data: null,
                        "render": function (data, type, row) {
                            return data["first_name"] + " " + data["last_name"];
                        }
                    },
                    {data: 'sex'},
                    {data: 'email'},
                    {data: 'contact_number'},
                    {
                        data: null,
                        render: function (data) {
                            let html = "";
                            html += '<a href="/public/patients/' + data.id + '/appointments/create" class="btn btn-round btn-info" ' +
                                'title="Make Appointment" data-toggle="tooltip"><i class="fa fa-phone"></i></a>';
                            html += '<a href="/public/patients/' + data["id"] + '" class="btn btn-round btn-info" ' +
                                'title="Edit" data-toggle="tooltip"><i class="fa ' +
                                'fa-pencil"></i></a>';
                            html += '<a href="/public/patients/' + data["id"] + '" class="btn btn-round btn-danger ajax-delete" ' +
                                'title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>';
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
            })
        });
    </script>
@endsection
