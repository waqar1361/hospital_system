@extends("layouts.auth")

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>Welcome</h1>
                            <p>For demo emails are</p>
                            
                            <h4>admin@example.com</h4>
                            <h4>doctor@example.com</h4>
                            <h4>nurse@example.com</h4>
                            
                            and password is <kbd>secret</kbd>
                            <h3>Login to continue</h3>
                            <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection