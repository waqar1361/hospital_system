@extends("layouts.app")
@section('page-title','Edit Physical Exam')
@section('page-description','Change physical exam')
@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Change Physical Exam</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form id="ajax-form" class="form-material" data-ajax="update"
                      action="{{ route('physicalExams.update',$exam->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group form-default">
                        <input id="name" type="text" name="exam_name" class="form-control"
                               value="{{ $exam->exam_name }}" required="">
                        <span class="form-bar"></span>
                        <label for="name" class="float-label">Exam Name</label>
                    </div>
                    
                    <div class="form-group form-default">
                        <select name="type" id="" class="custom-select">
                            <option value="basic" {{ $exam->type == 'basic' ? 'selected':'' }}>
                                Basic
                            </option>
                            <option value="comprehensive" {{ $exam->type == 'comprehensive' ? 'selected':''
                            }}>Comprehensive</option>
                        </select>
                    </div>

                    <div class="form-group form-default">
                        <input id="description" type="text" name="description" class="form-control"
                               value="{{ $exam->description }}" required="">
                        <span class="form-bar"></span>
                        <label for="description" class="float-label">Description</label>
                    </div>
                    
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
@endsection