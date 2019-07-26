@extends("layouts.app")
@section('page-title','Edit System Review')
@section('page-description','Change system review')
@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Change System Review</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form id="ajax-form" class="form-material" data-ajax="update"
                      action="{{ route('systemReviews.update',$SReview->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group form-default">
                        <input id="name" type="text" name="name" class="form-control"
                               value="{{ $SReview->name }}" required="">
                        <span class="form-bar"></span>
                        <label for="name" class="float-label">Name</label>
                    </div>
               
                    
                    <div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
@endsection