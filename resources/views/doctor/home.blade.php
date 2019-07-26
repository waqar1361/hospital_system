@extends("layouts.app")

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Welcome you logged in as  Doctor</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa-chevron-left"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-times close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
        
                                <div class="col-md col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('patients.index') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Patients
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="col-md col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('patients.create') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="fa fa-user-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Add Patient
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="col-md col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('visits.today') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Today Visits
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="col-md col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('visits.all') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="far fa-calendar-check-o"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Previous Visits
                                            </div>
                                        </a>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h5>Today's Visits</h5></div>
                        <div class="card-block">
                            <div class="table-responsive">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


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
                                html += '<a href="/public/visits/' + data['id'] + '/vitalSign/create" class="btn btn-round ' +
                                    'btn-info"' +
                                    'title="Capture Vitals" data-toggle="tooltip"><i class="fa fa-user-md"></i></a>';
                            }
                            
                            if (data['status'] == "ready") {
                                html += '<a href="/public/visits/' + data['id'] + '/notes/create" class="btn btn-round ' +
                                    'btn-info"' +
                                    'title="Attend Patient" data-toggle="tooltip"><i class="fa fa-stethoscope"></i></a>';
                            }
                            
                            if (data['status'] == "ready for cash") {
                                html += '<a href="/public/visits/' + data['id'] + '/discharge" class="btn btn-round btn-info ' +
                                    'discharge"' +
                                    'title="Discharge Patient" data-toggle="tooltip"><i class="fa fa-sign-out"></i></a>';
                            }
                            
                            if (data['status'] == "discharged") {
                                html += '<a href="/public/visits/' + data["id"] + '/details" class="btn btn-round btn-info"' +
                                    'title="Details" data-toggle="tooltip"><i class="fa fa-list-alt"></i></a>';
                            }
                            
                            return html;
                        }
                    }
                
                ]
            });
            
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>
@endsection
