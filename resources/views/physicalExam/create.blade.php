@extends("layouts.app")
@section('page-title','Add new Physical Exam')
@section('page-description','Create a new exam type')
@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Add Physical Exam</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <div class="form-group form-row">
                    <button type="button" class="btn btn-round btn-primary" id="add-more"
                            title="Add More" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-round btn-danger" id="remove-last"
                            title="Remove Last" data-toggle="tooltip">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <form id="ajax-form" class="form-material" action="{{ route('physicalExams.store') }}" method="post">
                    @csrf
                    <section id="physical-exams">

                        <div class="input-group form-group">
                            <div class="form-group form-default w-100">
                                <input id="name" type="text" name="exams[1][exam_name]" class="form-control"
                                       required="">
                                <span class="form-bar"></span>
                                <label for="name" class="float-label">Exam Name</label>
                            </div>
                            <div class="input-group-append">
                                <select name="exams[1][type]" id="" class="custom-select">
                                    <option value="basic" selected>Basic</option>
                                    <option value="comprehensive">Comprehensive</option>
                                </select>
                                <span class="form-bar"></span>
                            </div>
                        </div>
                        <div class="form-group form-default">
                            <input id="description" type="text" name="exams[1][description]" class="form-control"
                                   required="">
                            <span class="form-bar"></span>
                            <label for="description" class="float-label">Description</label>
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

            return '<div id="exams-' + $current + '">' +
                '<div class="input-group mb-3">' +
                '<div class="form-group form-default w-100">' +
                '<input id="name" type="text" name="exams[' + $current + '][exam_name]" class="form-control" required="">' +
                '<span class="form-bar"></span>' +
                '<label for="name" class="float-label">Exam Name</label>' +
                '</div>' +
                '<div class="input-group-append">' +
                '<select name="exams[' + $current + '][type]" id="" class="custom-select">' +
                '<option value="basic" selected>Basic</option>' +
                '<option value="comprehensive">Comprehensive</option>' +
                '</select>' +
                '<span class="form-bar"></span>' +
                '</div>' +
                '</div>' +
                '<div class="form-group form-default">' +
                '<input id="description" type="text" name="exams[' + $current + '][description]" class="form-control" required="">' +
                '<span class="form-bar"></span>' +
                '<label for="description" class="float-label">Description</label>' +
                '</div>' +
                '</div>';
        }

        $('#add-more').on('click', function () {
            $('#physical-exams').append(getHTML());
        });
        $('#remove-last').on('click', function () {
            if ($current > 1) {
                $('#exams-' + $current).remove();
                $current--;
            }
        });

    </script>
@endsection