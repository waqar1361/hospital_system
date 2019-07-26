@extends("layouts.app")

@section('content')
    <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-header"><h5>Note Vital Signs</h5></div>
            <div class="card-block">
                <form id="ajax-form" action="{{route('vitalSigns.store',$visit->id)}}" class="form-material" method="post">
                    @csrf
                    <div class="form-group form-default">
                        <input type="text" name="blood_pressure" class="form-control" placeholder="80/120">
                        <span class="form-bar"></span>
                        <label class="float-label">Blood Pressure</label>
                    </div>
        
                    <div class="form-group form-default">
                        <input type="text" name="pulse" class="form-control" placeholder="Pulse">
                        <span class="form-bar"></span>
                        <label class="float-label">Pulse</label>
                    </div>
        
                    <div class="form-group form-default">
                        <input type="text" name="respiration" class="form-control" placeholder="per mint">
                        <span class="form-bar"></span>
                        <label class="float-label">Respiration</label>
                    </div>
        
                    <div class="form-group form-default">
                        <input type="text" name="temperature" class="form-control" placeholder="in fahrenheit">
                        <span class="form-bar"></span>
                        <label class="float-label">Temperature</label>
                    </div>
        
                    <div class="form-group form-default">
                        <input type="text" name="height" class="form-control" placeholder="in feet">
                        <span class="form-bar"></span>
                        <label class="float-label">Height</label>
                    </div>
        
                    <div class="form-group form-default">
                        <input type="text" name="weight" class="form-control" placeholder="in lbs">
                        <span class="form-bar"></span>
                        <label class="float-label">Weight</label>
                    </div>
        
                    <div class="form-group form-default">
                        <input type="text" name="bmi" class="form-control" placeholder="BMI">
                        <span class="form-bar"></span>
                        <label class="float-label">BMI</label>
                    </div>
        
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
@endsection