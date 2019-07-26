@extends("layouts.app")

@section('content')

    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">

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

                            return '<a class="btn btn-round btn-info" href="/public/biller/bill_payed/'+data.id+'"' +
                                ' title="Bill Payed"  data-toggle="tooltip">' +
                                '<i class="fa fa-dollar"></i>' +
                                '</a>';
                        }
                    }

                ],
                // dom: 'Bfrtip',
                // buttons: [
                //     'copyHtml5',
                //     'excelHtml5',
                //     'csvHtml5',
                //     'pdfHtml5']
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>
@endsection






