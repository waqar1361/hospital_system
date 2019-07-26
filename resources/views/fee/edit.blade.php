@extends("layouts.app")
@section('page-title','Edit Visits\'s Fee')
@section('page-description','Change Visits\'s Fee')
@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Change Visit's Fee</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form id="ajax-form" class="form-material" data-ajax="update"
                      action="{{ route('fees.update',$fee->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group form-default">
                        <input id="type" type="text" name="type" class="form-control"
                               value="{{ $fee->type }}" required="">
                        <span class="form-bar"></span>
                        <label for="type" class="float-label">Type</label>
                    </div>
                    
                    <div class="form-group form-default">
                        <input id="fee" type="text" name="fee" class="form-control"
                               value="{{ $fee->fee }}" required="">
                        <span class="form-bar"></span>
                        <label for="fee" class="float-label">Fee</label>
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
@endsection