@extends("layouts.app")

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Billing</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-trash close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">

                            <form action="" class="form-material">
                                <div class="form-group form-default">
                                    <div class="form-row">

                                        <div class="col-md-4">
                                            <input id="date_birth" type="text" name="from"
                                                   class="form-control"
                                                   data-provide="datepicker" required="">
                                            <span class="form-bar"></span>
                                            <label for="date_birth" class="float-label">From</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input id="date_birth" type="text" name="to"
                                                   class="form-control"
                                                   data-provide="datepicker" required="">
                                            <span class="form-bar"></span>
                                            <label for="date_birth" class="float-label">To</label>
                                        </div>
                                        <div>
                                            <button class="btn btn-info" type="submit">Get</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    {{-- You can show whatever data you need --}}
                                    <tr>
                                        <th>Date</th>
                                        <th>Bill</th>
                                    </tr>
                                    @foreach($visits as $visit)
                                        <tr>
                                            <td>{{ $visit->created_at }}</td>
                                            <td>{{ $visit->bill }}</td>
                                        </tr>
                                    @endforeach
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Total</th>
                                        <td>{{ $visits->sum('bill') }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection