@extends("layouts.app")

@section('content')
    <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Fill up visit details</h5>
            </div>
            <div class="card-block">
                <form id="ajax-form" action="{{ route('visits.store', $patient->id) }}" class="form-material" method="post">
                    @csrf
                    <div class="form-group form-default">
                        <select name="type" class="form-control" id="type">
                            <option disabled selected>Select</option>
                            @foreach($visitsFees as $fee)
                                <option value="{{ $fee->type }}"
                                    data-fee="{{ $fee->fee }}" id="{{ $fee->type }}"
                                >{{ $fee->type }}</option>
                            @endforeach
                        </select>
                        <span class="form-bar"></span>
                        <label for="type" class="float-label">Type</label>
                    </div>
    
                    <div class="form-group form-default">
                        <input id="fee" type="text" name="fee" class="form-control" required="">
                        <span class="form-bar"></span>
                        <label for="fee" class="float-label">Fee</label>
                    </div>
                    
                    <div class="form-group form-default">
                        <input id="room" type="text" name="room" class="form-control" required="">
                        <span class="form-bar"></span>
                        <label for="room" class="float-label">Room Number</label>
                    </div>
                    
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        $('#type').on('change',function () {
            let $ID = $(this).val();
            let fee = $('#'+$ID).attr('data-fee');
            $('#fee').val(fee);
        })
    </script>
@endsection