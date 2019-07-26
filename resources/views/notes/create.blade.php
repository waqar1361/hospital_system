@extends("layouts.app")
@section('page-title','Add Patient Visit Details')
@section('page-description','Physician Notes, Patient History, Reviews')

@section('content')
    <style>
        .ck.ck-editor {
            box-shadow: 2px 2px 2px rgba(0, 0, 0, .1);
        }

        .ck.ck-content {
            font-size: 1em;
            line-height: 1.6em;
            margin-bottom: 0.8em;
            min-height: 200px;
            padding: 1em;
        }

        .pop {
            width: auto !important;
            z-index: 7;
        }

        .table {
            width: 100% !important;
        }
    </style>
    <div class="col-11 mx-auto">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>Clinic Info</h5>
                    </div>
                    <div class="card-block">

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>Patient Info</h5>
                    </div>
                    <div class="card-block">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>MRN</th>
                                <td>{{$patient->mrn}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$patient->fullname}}</td>
                            </tr>
                            <tr>
                                <th>Sex</th>
                                <td>{{$patient->sex}}</td>
                            </tr>
                            <tr>
                                <th>DOB</th>
                                <td>{{$patient->date_birth->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td>{{$patient->contact_number}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-11 mx-auto">
        <div class="card">
            <div class="card-header">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    @if ($patient->type == 'emr')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#vital-signs" role="tab"
                               aria-expanded="false">Vitals Signs</a>
                            <div class="slide"></div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#note" role="tab"
                           aria-expanded="true">Physician Note</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab"
                           aria-expanded="false">Reviews</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#physical-exams-tab" role="tab"
                           aria-expanded="false">Physical Examination</a>
                        <div class="slide"></div>
                    </li>
                </ul>

            </div>
            <!-- Tab panes -->
            <div class="tab-content card-block">
                {{--	Vital Signs	--}}
                @if ($patient->type == 'emr')
                    <div class="tab-pane" id="vital-signs" role="tabpanel" aria-expanded="false">
                        <div class="col-md-11 mx-auto">
                            <form action="{{route('vitalSigns.update',$vitalSign->id)}}" class="form-material ajax-form"
                                  method="post" data-ajax="update">
                                @csrf
                                @method('patch')
                                <div class="form-group form-default">
                                    <input type="text" name="blood_pressure" class="form-control" placeholder="80/120"
                                           value="{{ $vitalSign->blood_pressure ? $vitalSign->blood_pressure : '' }}">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Blood Pressure</label>
                                </div>

                                <div class="form-group form-default">
                                    <input type="text" name="pulse" class="form-control" placeholder="Pulse"
                                           value="{{ $vitalSign->pulse ? $vitalSign->pulse : '' }}">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Pulse</label>
                                </div>

                                <div class="form-group form-default">
                                    <input type="text" name="respiration" class="form-control" placeholder="per mint"
                                           value="{{ $vitalSign->respiration ? $vitalSign->respiration : '' }}">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Respiration</label>
                                </div>

                                <div class="form-group form-default">
                                    <input type="text" name="temperature" class="form-control"
                                           placeholder="in fahrenheit"
                                           value="{{ $vitalSign->temperature ? $vitalSign->temperature : '' }}">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Temperature</label>
                                </div>

                                <div class="form-group form-default">
                                    <input type="text" name="height" class="form-control" placeholder="in feet"
                                           value="{{ $vitalSign->height ? $vitalSign->height : '' }}">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Height</label>
                                </div>

                                <div class="form-group form-default">
                                    <input type="text" name="weight" class="form-control" placeholder="in lbs"
                                           value="{{ $vitalSign->weight ? $vitalSign->weight : '' }}">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Weight</label>
                                </div>

                                <div class="form-group form-default">
                                    <input type="text" name="bmi" class="form-control" placeholder="BMI"
                                           value="{{ $vitalSign->bmi ? $vitalSign->bmi : '' }}">
                                    <span class="form-bar"></span>
                                    <label class="float-label">BMI</label>
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                @endif
                {{--	Physican Note	--}}
                <div class="tab-pane active" id="note" role="tabpanel" aria-expanded="true">

                    <div class="container-fluid">
                        <form id="ajax-note" action="{{ route('notes.store', $visit->id) }}" method="post">
                            @csrf
                            {{--	Complaints	--}}
                            <div class="card">
                                <div class="card-header">
                                    <a data-toggle="collapse" href="#Complaints" role="button"
                                       aria-expanded="true" aria-controls="Complaints">
                                        <h5>Chief Complaints</h5>
                                    </a>
                                </div>
                                <div class="card-block collapse show form-material" id="Complaints">
                                    <div class="form-group form-default">
                                        <textarea class="form-control" name="chief_complaints"></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Chief Complaints</label>
                                    </div>
                                    <div class="form-group form-default">
                                        <textarea class="form-control" name="hpi"></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">HPI</label>
                                    </div>
                                </div>
                            </div>

                            {{--	Histories	--}}
                            <div class="card">
                                <div class="card-header">
                                    <a data-toggle="collapse" href="#Histories" role="button"
                                       aria-expanded="false" aria-controls="Histories">
                                        <h5>History</h5>
                                    </a>
                                </div>
                                <div class="card-block collapse form-material" id="Histories">

                                    <div class="form-group form-default">
										<textarea class="form-control" name="medical"
                                        >{{ $history ? $history->medical : ''}}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Medical History</label>
                                    </div>

                                    <div class="form-group form-default">
										<textarea class="form-control" name="social"
                                        >{{ $history ? $history->social : ''}}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Social History</label>
                                    </div>

                                    <div class="form-group form-default">
										<textarea class="form-control" name="surgical"
                                        >{{ $history ? $history->surgical : ''}}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Surgical History</label>
                                    </div>

                                    <div class="form-group form-default">
										<textarea class="form-control" name="immunization"
                                        >{{ $history ? $history->immunization : ''}}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Immunization History</label>
                                    </div>

                                    <div class="form-group form-default">
										<textarea class="form-control" name="family"
                                        >{{ $history ? $history->family : ''}}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Family History</label>
                                    </div>
                                </div>
                            </div>

                            {{--	Madication	--}}
                            <div class="card">
                                <div class="card-header">
                                    <a data-toggle="collapse" href="#Madication" role="button"
                                       aria-expanded="false" aria-controls="Madication">
                                        <h5>Medication & Allergies</h5>
                                    </a>
                                </div>
                                <div class="card-block collapse form-material" id="Madication">

                                    <div class="form-group form-default">
										<textarea class="form-control" name="medication"
                                        >{{ $history ? $history->medication : ''}}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Medication History</label>
                                    </div>

                                    <div class="form-group form-default">
										<textarea class="form-control" name="allergies"
                                        >{{ $history ? $history->allergies : ''}}</textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Allergies</label>
                                    </div>

                                </div>
                            </div>

                            {{--	Assessment	--}}
                            <div class="card">
                                <div class="card-header">
                                    <a data-toggle="collapse" href="#assessments" role="button"
                                       aria-expanded="false" aria-controls="assessments">
                                        <h5>Assessment</h5>
                                    </a>
                                </div>

                                <div class="card-block collapse form-material" id="assessments">

                                    {{--	Dispositions	--}}

                                    <h5 class="mb-2">Check the dispositions</h5>

                                    <div class="form-group" style="z-index: 7">
                                        <select name="check" class="dys" id="check_disposition" >
                                            @foreach($dispositions as $disposition)
                                                <option value="{{$disposition->id}}">{{ $disposition->diagnosis }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" id="mark-disposition" class="btn btn-info btn-round btn-sm">Check</button>
                                    </div>
                                    <hr>

                                    <div class="form-group d-flex flex-column">
                                        @foreach($dispositions as $disposition)
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input type="checkbox" name="diagnoses[]" id="checkBox-{{$disposition->id}}"
                                                           value="{{$disposition->diagnosis}}" data-toggle="collapse"
                                                           href="#diagnosis-{{$disposition->id}}"
                                                           aria-controls="diagnosis-{{$disposition->id}}">
                                                    <span class="cr">
                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                                    <span class="text-inverse">{{$disposition->diagnosis}}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group form-default">
                                        <textarea class="form-control" name="mdm"></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">MDM</label>
                                    </div>

                                    @foreach($dispositions as $disposition)

                                        <div class="collapse" id="diagnosis-{{$disposition->id}}">

                                            <div class="card" id="{{$disposition->spaceLessName}}">
                                                <div class="card-block">
                                                    <h4>{{ $disposition->diagnosis}} Disposition</h4>
                                                    <textarea name="dispositions[{{$disposition->diagnosis}}]"
                                                              class="editor">{{$disposition->disposition}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>

                            {{--	Tests and Treatments and Medications	--}}
                            <div class="card">
                                <div class="card-header">
                                    <a data-toggle="collapse" href="#tests-treatments" role="button"
                                       aria-expanded="false" aria-controls="tests-treatments">
                                        <h5>Tests & Treatments & Medications</h5>
                                    </a>
                                </div>
                                <div class="card-block collapse" id="tests-treatments">

                                    {{--	tests	--}}

                                    <h4 class="mb-2">Check Tests</h4>
                                    <div class="table-responsive">
                                        <table class="table form-material table-bordered" id="tests-table">
                                            <thead>
                                            <tr>
                                                <th>Check</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Quantity</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{--	treatments	--}}

                                    <h4 class="mb-2">Check Treatments</h4>
                                    <div class="table-responsive">
                                        <table class="table form-material table-bordered" id="treatments-table">
                                            <thead>
                                            <tr>
                                                <th>Check</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Quantity</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{--	medications	--}}

                                    <h4 class="mb-2">Check Medications</h4>
                                    <div class="table-responsive">
                                        <table class="table form-material table-bordered" id="medications-table">
                                            <thead>
                                            <tr>
                                                <th>Check</th>
                                                <th>Name</th>
                                                <th>Dosage</th>
                                                <th>SIG</th>
                                                <th>Quantity</th>
                                                <th>Refill</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            {{--	Treatment Plan	--}}
                            <div class="card">
                                <div class="card-header">
                                    <a data-toggle="collapse" href="#Treatment" role="button"
                                       aria-expanded="false" aria-controls="Treatment">
                                        <h5>Treatment Plan</h5>
                                    </a>
                                </div>
                                <div class="card-block collapse form-material" id="Treatment">

                                    <div class="form-group form-default">
                                        <textarea class="form-control" name="treatment"></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Treatment</label>
                                    </div>
                                    <div class="form-group form-default">
                                        <textarea class="form-control" name="prescribed_medicine"></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Prescribed Medicine</label>
                                    </div>

                                </div>
                            </div>

                            {{--	Care-plan	--}}
                            <div class="card">
                                <div class="card-header">
                                    <a data-toggle="collapse" href="#Care-plan" role="button"
                                       aria-expanded="false" aria-controls="Care-plan">
                                        <h5>Care Plan</h5>
                                    </a>
                                </div>
                                <div class="card-block collapse form-material" id="Care-plan">
                                    <div class="form-group form-default">
                                        <textarea class="form-control" name="care_plan"></textarea>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Care Plan</label>
                                    </div>

                                    <div id="plans">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>

                </div>
                {{--	Review System	--}}
                <div class="tab-pane" id="reviews" role="tabpanel" aria-expanded="true">
                    <div class="col-md-11 mx-auto">
                        <form class="form-material" id="ajax-form"
                              action="{{ route('reviews.store', $visit->id) }}" method="post">
                            @csrf

                            @foreach($systemReviews as $systemReview)
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#{{$systemReview->name}}" data-toggle="collapse" aria-expanded="false"
                                           aria-controls="{{$systemReview->name}}">
                                            <h5>
                                                {{ $systemReview->name}}
                                            </h5>
                                        </a>
                                    </div>
                                    <div class="collapse" id="{{$systemReview->name}}">
                                        <div class="card-block">
                                            @foreach($systemReview->SubOptions as $key => $subOption)

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-success reported"
                                                                data-get="{{$systemReview->name}}-{{$key}}-state">
                                                            Reported
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control col-2 text-right state"
                                                           name="reviews[{{$systemReview->name}}][{{$key}}][state]"
                                                           id="{{$systemReview->name}}-{{$key}}-state" readonly>
                                                    <input type="text" class="form-control" placeholder="description"
                                                           name="reviews[{{$systemReview->name}}][{{$key}}][description]"
                                                           value="{{$subOption->name}}">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-danger denial"
                                                                data-get="{{$systemReview->name}}-{{$key}}-state">Denial
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>

                    </div>
                </div>
                {{--	Physical Examination	--}}
                <div class="tab-pane" id="physical-exams-tab" role="tabpanel" aria-expanded="true">

                    <div class="col-md-10 mx-auto">
                        <form class="form-material ajax-form"
                              action="{{ route('patient.exams.store', $visit->id) }}" method="post">
                        @csrf

                        <!-- Nav panes -->
                            <ul class="nav nav-tabs  tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#basic-exam" role="tab"
                                       aria-expanded="true">Basic</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#detailed-exam" role="tab"
                                       aria-expanded="false">Comprehensive</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabs card-block">
                                {{--    Basic   --}}
                                <div class="tab-pane active" id="basic-exam" role="tabpanel" aria-expanded="true">

                                    @foreach($basic_exams as $exam)

                                        <div class="card">

                                            <a href="#{{$exam->type}}-{{$exam->exam_name}}" data-toggle="collapse"
                                               class="btn btn-out btn-block waves-effect waves-light btn-primary btn-square"
                                               aria-expanded="false" aria-controls="{{$exam->exam_name}}">
                                                {{ $exam->exam_name}}
                                            </a>

                                            <div class="collapse" id="{{$exam->type}}-{{$exam->exam_name}}">
                                                <div class="card-block">
                                                    <input type="text" class="form-control"
                                                           placeholder="Description"
                                                           name="exams[{{$exam->exam_name}}][basic_description]"
                                                           value="{{ $exam->description }}">
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                                {{--    Detailed    --}}
                                <div class="tab-pane" id="detailed-exam" role="tabpanel" aria-expanded="false">

                                    @foreach($detailed_exams as $exam)

                                        <div class="card">

                                            <a href="#{{$exam->type}}-{{$exam->exam_name}}" data-toggle="collapse"
                                               class="btn btn-out btn-block waves-effect waves-light btn-primary btn-square"
                                               aria-expanded="false" aria-controls="{{$exam->exam_name}}">
                                                {{ $exam->exam_name}}
                                            </a>

                                            <div class="collapse" id="{{$exam->type}}-{{$exam->exam_name}}">
                                                <div class="card-block">
                                                    <input type="text" class="form-control"
                                                           placeholder="Description"
                                                           name="exams[{{$exam->exam_name}}][detailed_description]"
                                                           value="{{ $exam->description }}">
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>


    {{--    Discharge Area  --}}
    <div class="col-11 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Discharge Patient</h5>
            </div>
            <div class="card-block">
                <section id="bill"></section>
                <div class="form-group">
                    <button class="btn btn-info"  onclick="readyToDischarge()">Ready To Discharge</button>
                    <button class="btn btn-info"  onclick="signed()">Singed</button>
                </div>
                <form action="{{ route('visits.discharge',$visit->id) }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary">Discharge</button>
                </form>
            </div>
        </div>
    </div>



    @if ($patient->type == 'tele_medicine')

        <style>
            .patient-chat {
                width: 35vw;
                max-height: 90vh;
                position: fixed;
                bottom: 0;
                right: 3rem;
            }

            #patient-chat-body .nav-link {
                padding: 5px 0 !important;
            }
        </style>
        <div class="patient-chat">
            <a data-toggle="collapse" href="#patient-chat-body" aria-expanded="false"
               aria-controls="patient-chat-body" class="text-white text-center h4">
                <div class="card-header bg-secondary text-white">
                    <i class="far fa-comments"></i> Live Chat
                </div>
            </a>
            <div class="collapse" id="patient-chat-body">
                <div class="card-block bg-light">
                    <style>
                        #chat-area {
                            max-height: 30vh;
                            overflow-y: scroll;
                        }
                    </style>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#ChatTab"
                               role="tab">Chat</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#VideoTab" role="tab">Video</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="ChatTab" role="tabpanel">

                            <div class="form-group" id="chat-area">
                                @foreach($messages as $message)
                                    <div class="card mb-1">
                                        <div class="p-2
                                    {{ $message->sender == 'patient' ? 'text-dark' : '' }}
                                        {{ $message->sender == 'doctor' ? 'text-primary' : '' }}
                                        {{ $message->sender == 'nurse' ? 'text-danger' : '' }}
                                                ">
                                            <b>{{ $message->sender == 'patient' ? $patient->fullname : $message->sender }}
                                                :</b>
                                            {{ $message->messages }}
                                            <span class="pull-right">{{ $message->created_at }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-row form-material">
                                <div class="col-10">
                                    <div class="form-group form-primary">
                                        <input type="text" id="message" name="footer-email"
                                               class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Type Here</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary btn-block"
                                            id="send-btn"
                                            type="button">
                                        <i class="fa fa-send"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="VideoTab" role="tabpanel">

                            <iframe width="90%" height="500px" src="//appr.tc/r/{{ $patient->id }}"
                                    allow="geolocation; microphone; camera"></iframe>

                        </div>
                    </div>

                </div>
            </div>
        </div>


    @endif

@endsection

@section('page-script')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        function readyToDischarge() {
            $.ajax({
                    url: '{{ route('visits.readytodischarge',$visit->id) }}',
                    type: "get",
                    data: {},
                    success: function (response) {
                        notify("Ready To Discharge", 'success');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }

                });
        }

        function signed() {
            $.ajax({
                url: '{{ route('visits.signed',$visit->id) }}',
                type: "get",
                data: {},
                success: function (response) {
                    notify("sigend", 'success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }

        $('#check_disposition').dys();
        $('#mark-disposition').on('click',function (event) {
            event.preventDefault();
            var $ID = $('#check_disposition').val();
            $('#checkBox-'+$ID).prop('checked', true);
            $('#diagnosis-'+$ID).collapse('show');
        });
        var allEditors = document.querySelectorAll('.editor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]);
        }

        $('#medication-form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: "get",
                data: $(this).serialize(),
                success: function (response) {
                    $('#print').html(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        });

        $(document.body).on('click', '.reported', function () {
            let id = $(this).attr('data-get');
            let state = $('#' + id);
            state.val('reported : ');
        });
        $(document.body).on('click', '.denial', function () {
            let id = $(this).attr('data-get');
            let state = $('#' + id);
            state.val('denial : ');
        });

        $('#tests-table').dataTable({
            data: {!! $tests !!},
            columns: [
                {
                    data: null,
                    render: function (data) {
                        return '<div class="checkbox-fade fade-in-primary d-">' +
                            '<label>' +
                            '<input type="checkbox"' +
                            ' name="patient_tests[' + data.id + '][id]"' +
                            ' value="' + data.id + '">' +
                            '<span class="cr">' +
                            '<i class="cr-icon icofont icofont-ui-check txt-primary"></i>' +
                            '</span>' +
                            // '<span class="text-inverse">' + data.name + '</span>' +
                            '</label>' +
                            '</div>' +
                            '<input type="hidden" name="patient_tests[' + data.id + '][name]"' +
                            ' value="' + data.name + '">' +
                            '<input type="hidden" name="patient_tests[' + data.id + '][cost]"' +
                            ' value="' + data.cost + '">' +
                            '<input type="hidden" name="patient_tests[' + data.id + '][type]"' +
                            ' value="' + data.type + '">';
                    }
                },
                {data: 'name'},
                {data: 'type'},
                {
                    data: null,
                    render: function (data) {
                        return '<input type="number" class="form-control" name="patient_tests[' + data.id + '][quantity]">';
                    }
                },
            ]
        });
        $('#treatments-table').dataTable({
            data: {!! $treatments !!},
            columns: [
                {
                    data: null,
                    render: function (data) {
                        return '<div class="checkbox-fade fade-in-primary d-">' +
                            '<label>' +
                            '<input type="checkbox"' +
                            ' name="patient_treatments[' + data.id + '][id]"' +
                            ' value="' + data.id + '">' +
                            '<span class="cr">' +
                            '<i class="cr-icon icofont icofont-ui-check txt-primary"></i>' +
                            '</span>' +
                            // '<span class="text-inverse">' + data.name + '</span>' +
                            '</label>' +
                            '</div>' +
                            '<input type="hidden" name="patient_treatments[' + data.id + '][name]"' +
                            ' value="' + data.name + '">' +
                            '<input type="hidden" name="patient_treatments[' + data.id + '][cost]"' +
                            ' value="' + data.cost + '">' +
                            '<input type="hidden" name="patient_treatments[' + data.id + '][type]"' +
                            ' value="' + data.type + '">';
                    }
                },
                {data: 'name'},
                {data: 'type'},
                {
                    data: null,
                    render: function (data) {
                        return '<input type="number" class="form-control" name="patient_treatments[' + data.id + '][quantity]">';
                    }
                },
            ]
        });
        $('#medications-table').dataTable({
            data: {!! $medications !!},
            columns: [
                {
                    data: null,
                    render: function (data) {
                        return '<div class="checkbox-fade fade-in-primary d-">' +
                            '<label>' +
                            '<input type="checkbox"' +
                            ' name="patient_medications[' + data.id + '][id]"' +
                            ' value="' + data.id + '">' +
                            '<span class="cr">' +
                            '<i class="cr-icon icofont icofont-ui-check txt-success"></i>' +
                            '</span>' +
                            '</label>' +
                            '</div>' +
                            '<input type="hidden"' +
                            ' name="patient_medications[' + data.id + '][name]"' +
                            ' value="' + data.name + '">' +
                            '<input type="hidden"' +
                            ' name="patient_medications[' + data.id + '][cost]"' +
                            ' value="' + data.cost + '">' +
                            '<input type="hidden"' +
                            ' name="patient_medications[' + data.id + '][type]"' +
                            ' value="' + data.type + '">' +
                            '<input type="hidden"' +
                            ' name="patient_medications[' + data.id + '][sig]"' +
                            ' value="' + data.sig + '">' +
                            '<input type="hidden"' +
                            ' name="patient_medications[' + data.id + '][dispense]"' +
                            ' value="' + data.dispense + '">' +
                            '<input type="hidden"' +
                            ' name="patient_medications[' + data.id + '][refill]"' +
                            ' value="' + data.refill + '">';
                    }
                },
                {data: 'name'},
                {data: 'dispense'},
                {data: 'sig'},
                {
                    data: null,
                    render: function (data) {
                        return '<input type="number" class="form-control" name="patient_medications[' + data.id + '][quantity]">';
                    }
                },
                {data: 'refill'}
            ]
        });

    </script>
    <script src="{{asset('js/PatientVisits.js')}}"></script>
@endsection


{{--    Live Chat Code  --}}
@if ($patient->type == 'tele_medicine')

    @push('js')
        <script>
            var currentCount = {{ $messages->count() }}, patientID = {{ $patient->id }}, MRN = {{ $patient->mrn }};

            function checkCountMessages() {
                $.ajax({
                    url: '{{ route('patient.liveChat') }}',
                    type: "post",
                    data: {
                        count: currentCount,
                        patient_id: {{ $patient->id }},
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.received == true) {
                            currentCount++;
                            $('#chat-area').append(response.message);
                            $('#chat-area').animate({scrollTop: 5000}, 50);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }

                });
            }

            function sendMessage() {
                let $message = $('#message');
                let message = $message.val();
                $message.val('');
                currentCount++;
                $.ajax({
                    url: '{{ route('conversations.store') }}',
                    type: "post",
                    data: {
                        messages: message,
                        patient_id: patientID,
                        sender: '{{ auth()->user()->type == 'admin' ? 'doctor' : auth()->user()->type}}',
                        sender_id: MRN,
                    },
                    success: function (response) {
                        $('#chat-area').append(response);
                        $('#chat-area').animate({scrollTop: 5000}, 50);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }

                });
            }

            $('#send-btn').on('click', function (event) {
                event.preventDefault();
                sendMessage();
            });

            $('#message').on("keyup", function (event) {
                event.preventDefault();
                if (event.keyCode === 13) {
                    sendMessage();
                }
            });

            $('#patient-chat-body').on('click', function () {
                $('#chat-area').animate({scrollTop: 5000}, 50);
            });

            $(document).ready(function () {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                setInterval(function () {
                    checkCountMessages();
                }, 1000);
            });
        </script>
    @endpush
@endif
