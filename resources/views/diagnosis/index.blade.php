@extends("layouts.app")
@section('page-title','Diagnosis')
@section('page-description','List of all Diagnosis')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>Diagnosis
                <a href="{{route('diagnosis.create')}}" class="btn btn-info btn-sm btn-round">
                    <i class="fa fa-plus"></i>
                </a>
            </h5>
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
                        <th>Diagnosis</th>
                        <th>Disposition</th>
                        {{--<th>Actions</th>--}}
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
                data: {!! $diagnoses !!},
                columns: [
                    {data: 'diagnosis'},
                    {
                        data: null,
                        render: function (data) {
                            if (data.disposition) {
                                return data.disposition
                            } else {
                                return 'N/A';
                            }
                        }
                    }
                    // {
                    //     data: null,
                    //     render: function (data) {
                    //         return '<a href="/diagnosis/' + data["id"] + '/edit" class="btn btn-round btn-info" ' +
                    //             'title="edit" data-toggle="tooltip">' +
                    //             '<i class="fa fa-pencil"></i></a>' +
                    //             '<a href="/diagnosis/' + data["id"] + '" class="btn btn-round btn-danger ajax-delete" ' +
                    //             'data-id="' + data["id"] + '" title="delete" data-toggle="tooltip">' +
                    //             '<i class="fa fa-trash"></i>' +
                    //             '</a>';
                    //     }
                    // }

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