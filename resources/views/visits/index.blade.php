@extends("layouts.app")
@section('page-title','Visits')
@section('page-description','Patient\'s all visits')

@section('content')
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Patient Info</h5>
            </div>
            <div class="card-block">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>MRN</th>
                        <td>{{$patient->mrn}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$patient->fullname}}</td>
                    </tr>
                    <tr>
                        <th>Sex</th>
                        <td>{{$patient->sex}}</td>
                    </tr>
                    <tr>
                        <th>DOB</th>
                        <td>{{$patient->date_birth->format('d-m-Y')}}</td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td>{{$patient->contact_number}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Visits</h5>
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
                    @include('visits.table')
                </div>
            </div>
        </div>
    </div>
@endsection