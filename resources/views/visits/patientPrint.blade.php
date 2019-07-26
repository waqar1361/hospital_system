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
                        {{--<tr>--}}
                            {{--<th>MRN</th>--}}
                            {{--<td>{{$patient->mrn}}</td>--}}
                        {{--</tr>--}}
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
    <button class="btn btn-info" onclick="window.print()">Print it</button>
</div>


</body>
</html>