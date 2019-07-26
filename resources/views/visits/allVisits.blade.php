@extends("layouts.app")
@section('page-title','Visits')
@section('page-description','List of all visits')

@section('content')
	
	{{--<div class="col-6">--}}
		{{--<div class="card">--}}
			{{--<div class="card-header">--}}
				{{--<h5>Patient Info</h5>--}}
			{{--</div>--}}
			{{--<div class="card-block">--}}
				{{--<div><strong>Name</strong> {{$patient->fullname}}</div>--}}
				{{--<div><strong>Sex</strong> {{$patient->sex}}</div>--}}
				{{--<div><strong>DOB</strong> {{$patient->date_birth}}</div>--}}
				{{--<div><strong>Contact</strong> {{$patient->contact_number}}</div>--}}
			{{--</div>--}}
		{{--</div>--}}
	{{--</div>--}}
	
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h5>Visits</h5>
				<div class="card-header-right">
					<ul class="list-unstyled card-option">
						<li><i class="fa fa fa-wrench open-card-option"></i></li>
						<li><i class="fa fa-window-maximize full-card"></i></li>
						<li><i class="fa fa-minus minimize-card"></i></li>
						<li><i class="fa fa-refresh reload-card"></i></li>
						<li><i class="fa fa-trash close-card"></i></li>
					</ul>
				</div>
			</div>
			<div class="card-block table-border-style">
				<div class="table-responsive">
					@if (isset($today))
						@include('visits.today')
					@else
						@include('visits.allTable')
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection