@extends("layouts.app")
@section('page-title','Medication')
@section('page-description','Details of all Medication')

@section('content')
    
    <div class="card">
        <div class="card-header">
            <h5>Medication</h5>
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
                        <th>Name</th>
                        <th>Type</th>
                        <th>SIG</th>
                        <th>Dispense</th>
                        <th>Refill</th>
                        <th>Price</th>
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
                data: {!! $medications !!},
                columns: [
                    {data: 'name'},
                    {data: 'type'},
                    {data: 'sig'},
                    {data: 'dispense'},
                    {data: 'refill'},
                    {data: 'cost'},
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="/medications/' + data["id"] + '/edit" class="btn btn-round btn-info"><i class="fa ' +
                                'fa-pencil"></i></a>' +
                                '<a href="/medications/' + data["id"] + '" class="btn btn-round btn-danger ajax-delete" ' +
                                'data-id="' + data["id"] + '">' +
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