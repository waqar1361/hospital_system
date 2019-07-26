@extends("layouts.app")
@section('page-title','Add new System Review')
@section('page-description','Create a new review type')
@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Add System Sub Options Reviews</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <div class="form-group form-row">
                    <button type="button" class="btn btn-round btn-primary" id="add-more">
                        <i class="fa fa-plus"></i> Add More
                    </button>
                    <button type="button" class="btn btn-round btn-danger" id="remove-last">
                        <i class="fa fa-plus"></i> Remove Last
                    </button>
                </div>
                
                <form id="ajax-form" class="form-material" action="{{ route('systemReviewsSuboption.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="r_id" value="{{$r_id}}">
                    <section id="system-reviews">
                        <div class="form-group form-default">
                            <input id="name" type="text" name="name[]" class="form-control" required="">
                            <span class="form-bar"></span>
                            <label for="name" class="float-label">ROS Suboption</label>
                        </div>
                    </section>
                   
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        var $current = 1;
        function getHTML() {
            $current++;
            return '<div id="review-'+ $current+'" class="form-group form-default"><input id="name" type="text" name="name[]"' +
                'class="form-control"><span class="form-bar"></span><label for="name" ' +
                'class="float-label">ROS Suboption</label></div>';
        }
        $('#add-more').on('click',function () {
            $('#system-reviews').append(getHTML());
        });
        $('#remove-last').on('click',function () {
            if ($current > 1)
           {
               $('#review-' + $current).remove();
               $current--;
           }
        });
        
    </script>
@endsection

