@extends("layouts.app")
@section('page-title','Make Patient Appointment')
@section('page-description','Provide time of appointment')
@section('content')
    <div class="col-md-8 mx-auto mt-5">
        <div class="card">
            <div class="card-header">
                <h5>Appointment Details</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form id="ajax-form" class="form-material" action="{{ route('appointments.store',$patient->id) }}" method="post">
                    @csrf

                    <div class="form-group form-default">
                        <input id="time" type="text" name="time" class="form-control"
                               data-provide="datepicker" required="">
                        <span class="form-bar"></span>
                        <label for="time" class="float-label">Appointment Date</label>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection