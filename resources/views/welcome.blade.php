@extends("layouts.auth")

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card text-center text-capitalize">
                <div class="card-header">
                    <h1>Select your choice</h1>
                </div>
                <div class="card-block form-row">
                    
                    <div class="col">
                        <a class="btn btn-outline-info" href="{{route('home')}}"><h1 class="display-5">EMR</h1></a>
                    </div>
                    <div class="col">
                        <a class="btn btn-outline-info" href="#"><h1 class="display-5">After Care</h1></a>
                    </div>
                    <div class="col">
                        <a class="btn btn-outline-info" href="{{route('patients.teleMed')}}"><h1 class="display-5">Tele medicine</h1></a>
                    </div>
                    @admin()
                    <div class="col">
                        <a class="btn btn-outline-info" href="{{ route('admin.billing') }}"><h1 class="display-5">Billing</h1></a>
                    </div>
                    @endadmin
                </div>
            </div>
        </div>
    </div>
@endsection
