<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visit Details</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">

    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">--}}
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">--}}
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap/js/bootstrap.min.js') }} "></script>

</head>
<body>
<div class="col-11 mx-auto">
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Clinic Info</h5>
                </div>
                <div class="card-body">
                    <h2>Total Bill : {{ $visit->bill }}</h2>
                    {{--<div><strong>Name</strong> {{$patient->fullname}}</div>--}}
                    {{--<div><strong>Sex</strong> {{$patient->sex}}</div>--}}
                    {{--<div><strong>DOB</strong> {{$patient->date_birth}}</div>--}}
                    {{--<div><strong>Contact</strong> {{$patient->contact_number}}</div>--}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Patient Info</h5>
                </div>
                <div class="card-body">
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

    {{--    Vital Signs --}}
    <div class="card mb-4">
        <div class="card-body">
            @if ($sign)
                <h5>Vital Signs</h5>
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

    {{--	Complaints	--}}
    <div class="card mb-4">

        <div class="card-body">
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
    <div class="card mb-4">


        <div class="card-body">
            <h3>History</h3>

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
    <div class="card mb-4">


        <div class="card-body" id="Madication">
            <h3>Medication & Allergies</h3>

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
    <div class="card mb-4">

        <div class="card-body" id="Assessment">
            <h3>Dispositions</h3>
            @forelse($dispositions as $disposition)
                <h5>{{ $disposition->diagnosis }}</h5>
                {!!  $disposition->disposition !!}
            @empty
                N/A
            @endforelse
            <h5>MDM</h5>
            @if($note)
                <p>{{ $note->mdm == null ? 'N/A' : $note->mdm }}</p>
            @endif
        </div>
    </div>

    {{--	Treatments, Tests, Medications 	--}}
    <div class="card mb-4">


        <div class="card-body">
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
    <div class="card mb-4">


        <div class="card-body " id="Treatment">

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
    <div class="card mb-4">


        <div class="card-body" id="Care-plan">
            <h5>Care Plan</h5>
            @if($note)
                {{ $note->care_plan == null ? 'N/A' : $note->care_plan }}
            @endif
        </div>
    </div>

    {{--    ROS     --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5>ROS</h5>
            @forelse($reviews as $ros)

                <h5>{{$ros['name']}}</h5>

                @foreach($ros['reviews'] as $ros)
                    <p>{{ $ros->description }}</p>
                @endforeach

            @empty

                <h5>No reviews</h5>

            @endforelse
        </div>
    </div>

    {{--    Examinations    --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5>Physical Examination</h5>
            @if ($exams)
                @foreach($exams as $exam)
                    <p class="lead">
                        {{ $exam->basic_description ?  $exam->exam_name .'-Basic : '. $exam->basic_description: ''}}
                    </p>
                    <p class="lead">
                        {{ $exam->detailed_description ?  $exam->exam_name .'-Comprehensive : '.
                        $exam->detailed_description: ''}}
                    </p>
                @endforeach
            @else
                <h5>N/A</h5>
            @endif
        </div>
    </div>

    <button class="btn btn-info" onclick="window.print()">Print it</button>
</div>


</body>
</html>