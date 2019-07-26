@extends("layouts.app")
@section('page-title','Add Notes')
@section('page-description','Admin Notes')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>Add Notes</h5>
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
                                <a href="{{ route('systemReviews.create') }}">
                                    <div class="card-body">
                                        <div class="icon">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer" title="Reviews of system" data-toggle="tooltips">
                                        ROS
                                    </div>
                                </a>
                            </div>
                        </div>
    
                        <div class="col-md col-sm-6">
                            <div class="card text-center dashboard-card">
                                <a href="{{ route('physicalExams.create') }}">
                                    <div class="card-body">
                                        <div class="icon">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        Physical Exam
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md col-sm-6">
                            <div class="card text-center dashboard-card">
                                <a href="{{route('diagnosis.create')}}">
                                    <div class="card-body">
                                        <div class="icon">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        Diagnosis
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md col-sm-6">
                            <div class="card text-center dashboard-card">
                                <a href="{{ route('dispositions.create') }}">
                                    <div class="card-body">
                                        <div class="icon">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        Disposition
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        
                    
                    </div>
                    <div class="row">
        
                        <div class="col-md col-sm-6">
                            <div class="card text-center dashboard-card">
                                <a href="{{ route('systemReviews.index') }}">
                                    <div class="card-body">
                                        <div class="icon">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer" title="Reviews of system" data-toggle="tooltips">
                                        ROS
                                    </div>
                                </a>
                            </div>
                        </div>
        
                        <div class="col-md col-sm-6">
                            <div class="card text-center dashboard-card">
                                <a href="{{ route('physicalExams.index') }}">
                                    <div class="card-body">
                                        <div class="icon">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        Physical Exam
                                    </div>
                                </a>
                            </div>
                        </div>
        
                        <div class="col-md col-sm-6">
                            <div class="card text-center dashboard-card">
                                <a href="{{route('diagnosis.index')}}">
                                    <div class="card-body">
                                        <div class="icon">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        Diagnosis
                                    </div>
                                </a>
                            </div>
                        </div>
        
                        <div class="col-md col-sm-6">
                            <div class="card text-center dashboard-card">
                                <a href="{{route('dispositions.index')}}">
                                    <div class="card-body">
                                        <div class="icon">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        Disposition
                                    </div>
                                </a>
                            </div>
                        </div>
    
    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection