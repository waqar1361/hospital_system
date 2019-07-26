@extends("layouts.app")
@section('page-title','Patient Visit')
@section('page-description','Visit Details')

@section('content')
    <div class="col-11 mx-auto">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>Clinic Info</h5>
                    </div>
                    <div class="card-block">
                        <h2>Total Bill : {{ $visit->bill }}</h2>
                        {{--<div><strong>Name</strong> {{$patient->fullname}}</div>--}}
                        {{--<div><strong>Sex</strong> {{$patient->sex}}</div>--}}
                        {{--<div><strong>DOB</strong> {{$patient->date_birth}}</div>--}}
                        {{--<div><strong>Contact</strong> {{$patient->contact_number}}</div>--}}
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
        <!-- Nav tabs -->
        <div class="card">
            <div class="card-header">

                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#note" role="tab"
                           aria-expanded="true">Physician Note</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#vital-signs" role="tab"
                           aria-expanded="false">Vitals Signs</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab"
                           aria-expanded="false">Reviews</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#exams" role="tab"
                           aria-expanded="false">Physical Exams</a>
                        <div class="slide"></div>
                    </li>
                </ul>

            </div>

            <!-- Tab panes -->
            <div class="tab-content card-block">
                {{--	Physican Note	--}}
                <div class="tab-pane active" id="note" role="tabpanel" aria-expanded="true">

                    <div class="col-md-11 mx-auto">

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
                                    <h5>Chief Complaints</h5>
                                    @if($note)
                                        <p>{{ $note->chief_complaints == null ? "N/A" : $note->chief_complaints }}</p>
                                    @endif
                                    <h5>HPI</h5>

                                    @if($note)
                                        <p>{{ $note->hpi == null ? "N/A" : $note->hpi }}</p>
                                    @endif

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

                                <h5>Medical History</h5>
                                @if($history)
                                    <p>{{ $history->medical == null ? "N/A" : $history->medical  }}</p>
                                @endif
                                <h5>Social History</h5>
                                @if($history)
                                    <p>{{ $history->social == null ? "N/A" : $history->social  }}</p>
                                @endif
                                <h5>Surgical History</h5>
                                @if($history)
                                    <p>{{ $history->surgical }}</p>
                                @endif
                                <h5>Immunization History</h5>
                                @if($history)
                                    <p>{{ $history->immunization == null ? "N/A" : $history->immunization  }}</p>
                                @endif
                                <h5>Family History</h5>
                                @if($history)
                                    <p>{{ $history->family == null ? "N/A" : $history->family  }}</p>
                                @endif

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

                                <h5>Medication History</h5>
                                @if($history)
                                    <p>{{ $history->medication == null ? "N/A" : $history->medication  }}</p>
                                @endif
                                <h5>Allergies</h5>
                                @if($history)
                                    <p>{{ $history->allergies == null ? "N/A" : $history->allergies  }}</p>
                                @endif
                            </div>
                        </div>
                        {{--	Assessment	--}}
                        <div class="card">
                            <div class="card-header">
                                <a data-toggle="collapse" href="#Assessment" role="button"
                                   aria-expanded="false" aria-controls="Assessment">
                                    <h5>Dispositions</h5>
                                </a>
                            </div>
                            <div class="card-block collapse form-material" id="Assessment">
                                @forelse($dispositions as $disposition)
                                    <h5>{{ $disposition->diagnosis }}</h5>
                                    {!!  $disposition->disposition == null ? 'N/A' : $disposition->disposition  !!}
                                @empty
                                    N/A
                                @endforelse
                                <h5>MDM</h5>
                                @if($note)
                                    <p>{{ $note->mdm == null ? 'N/A' : $note->mdm }}</p>
                                @endif
                            </div>
                        </div>
                        {{--	Tests, Treatments, Medicatins	--}}
                        <div class="card">
                            <div class="card-header">
                                <a data-toggle="collapse" href="#test-treatment" role="button"
                                   aria-expanded="false" aria-controls="test-treatment">
                                    <h5>Tests, Treatments & Medications </h5>
                                </a>
                            </div>
                            <div class="card-block collapse form-material" id="test-treatment">
                                {{--    Tests  --}}
                                <h5>Tests</h5>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($tests as $test)
                                        <tr>
                                            <td>{{ $test->name }}</td>
                                            <td>{{ $test->type }}</td>
                                            <td>{{ $test->quantity }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">N/A</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{--    Treatments  --}}
                                <h5>Treatments</h5>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($treatments as $treatment)
                                        <tr>
                                            <td>{{ $treatment->name }}</td>
                                            <td>{{ $treatment->type }}</td>
                                            <td>{{ $treatment->quantity }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">N/A</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{--    Medications  --}}
                                <h5>Medications</h5>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>SIG</th>
                                        <th>Refill</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($medications as $medication)
                                        <tr>
                                            <td>{{ $medication->name }}</td>
                                            <td>{{ $medication->type }}</td>
                                            <td>{{ $medication->sig }}</td>
                                            <td>{{ $medication->refill }}</td>
                                            <td>{{ $medication->quantity }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">N/A</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

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
                                <h5>Treatment</h5>
                                @if($note)
                                    <p>{{ $note->treatment == null ? 'N/A' : $note->treatment }}</p>
                                @endif
                                <h5>Prescribed Medicine</h5>
                                @if($note)
                                    <p>{{ $note->prescribed_medicine == null ? 'N/A' : $note->prescribed_medicine }}</p>
                                @endif
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
                                @if($note)
                                    {{ $note->care_plan == null ? 'N/A' : $note->care_plan }}
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
                {{--	Vital Signs	--}}
                <div class="tab-pane" id="vital-signs" role="tabpanel" aria-expanded="false">

                    <div class="col-md-11 mx-auto">
                        @if ($sign)
                            <table class="table">
                                <tr>
                                    <th>Blood Pressure</th>
                                    <td>{{ $sign->blood_pressure }}</td>
                                </tr>
                                <tr>
                                    <th>Pulse</th>
                                    <td>{{ $sign->pulse }}</td>
                                </tr>
                                <tr>
                                    <th>Respiration</th>
                                    <td>{{ $sign->respiration }}/min</td>
                                </tr>
                                <tr>
                                    <th>Temperature</th>
                                    <td>{{ $sign->temperature }} &#8457;</td>
                                </tr>
                                <tr>
                                    <th>Height</th>
                                    <td>{{ $sign->height }} ft</td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td>{{ $sign->weight }} lbs</td>
                                </tr>
                                <tr>
                                    <th>BMI</th>
                                    <td>{{ $sign->bmi }}</td>
                                </tr>
                            </table>
                        @else
                            <h5>N/A</h5>
                        @endif
                    </div>

                </div>
                {{--	Review System	--}}
                <div class="tab-pane" id="reviews" role="tabpanel" aria-expanded="false">

                    <div class="col-md-11 mx-auto">
                        @forelse($reviews as $ros)
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{$ros['name']}}</h5>
                                </div>
                                <div class="card-block lead">
                                    @foreach($ros['reviews'] as $ros)
                                        <p>{{ $ros->description }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="card-block">
                                <h5>No review to show</h5>
                            </div>
                        @endforelse
                    </div>

                </div>
                {{--	Physical Examination	--}}
                <div class="tab-pane" id="exams" role="tabpanel" aria-expanded="false">

                    <div class="col-md-11 mx-auto">
                        @forelse($exams as $exam)
                            <p class="lead">
                                {{ $exam->basic_description ?  $exam->exam_name .'-Basic : '. $exam->basic_description: ''}}
                            </p>
                            <p class="lead">
                                {{ $exam->detailed_description ?  $exam->exam_name .'-Comprehensive : '.
                                $exam->detailed_description: ''}}
                            </p>
                        @empty
                            <h4>N/A</h4>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-11 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Print Details</h5>
            </div>
            <div class="card-block">

                <a href="{{route('visits.print',$visit->id)}}?type=doctor" class="btn btn-primary">Print for Doctor</a>
                <a href="{{route('visits.print',$visit->id)}}" class="btn btn-primary">Print for Patient</a>

            </div>
        </div>
    </div>

@endsection