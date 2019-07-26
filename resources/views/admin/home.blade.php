@extends("layouts.app")

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Welcome you logged in as admin</h5>
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
    
                            <div class="row">
    
                                <div class="col-md col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('treatments.create') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="fas fa-syringe"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Add Treatment
                                            </div>
                                        </a>
                                    </div>
                                </div>
    
                                <div class="col-md col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('tests.create') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="fas fa-vial"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Add Test
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="col-md col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('users.index') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Users
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="col-md col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('users.create') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="fa fa-user-md"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Add User
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                            
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
    
                            <div class="row">
        
                                <div class="col-md-3 col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('fees.create') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="fa fa-cog"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Add Visit Fee
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="card text-center dashboard-card">
                                        <a href="{{ route('addNotes') }}">
                                            <div class="card-body">
                                                <div class="icon">
                                                    <i class="fa fa-cogs"></i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Add Notes
                                            </div>
                                        </a>
                                    </div>
                                </div>
    
                            </div>
                            
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection