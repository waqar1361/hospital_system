@extends("layouts.app")
@section('page-title','Users')
@section('page-description','Details of all Users')

@section('content')
    
    <div class="card">
        <div class="card-header">
            <h5>Users</h5>
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
        <div class="card-block">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th>Lic No</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                data: {!! $users !!},
                columns: [
                    {
                        data: null,
                        "render": function (data, type, row) {
                            return (data["first_name"] +" "+ data["last_name"])
                        }
    
                    },
                    {data: 'type'},
                    {data: 'email'},
                    {data: 'salary'},
                    {data: 'lic_no'},
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="/users/'+data["id"] +'" class="btn btn-round btn-info"><i class="fa fa-pencil"></i></a>' +
                                '<a href="/users/'+data["id"] +'" class="btn btn-round btn-danger ajax-delete" ' +
                                'data-id="'+data["id"] +'">' +
                                '<i class="fa fa-trash"></i>' +
                                '</a>';
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
        })
    </script>
@endsection