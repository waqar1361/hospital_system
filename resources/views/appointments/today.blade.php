@extends("layouts.app")
@section('page-title','Appointments')
@section('page-description','List of tele medicine patients appointments')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>Appointments</h5>
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
                        <th>Visit Date</th>
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
                data: {!! $appointments !!},
                columns: [
                    {data: 'patient.mrn'},
                    {data: 'appointment_time'},
                    {
                        data: null,
                        "render": function (data) {
                            return data.patient.first_name + " " + data.patient.last_name;
                            // return '<a class="btn-link" href="patients/' + data['id'] + '/visits">' + name + '</a>';
                        }
                    },
                    {data: 'patient.sex'},
                    {data: 'patient.email'},
                    {data: 'patient.contact_number'},
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="/public/patients/'+data.patient.id+'/appointments/attend" class="btn btn-round btn-info"' +
                                ' title="Attend" data-toggle="tooltip"><i class="fa fa-stethoscope"></i></a>';

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
