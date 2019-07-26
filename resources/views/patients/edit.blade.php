@extends("layouts.app")
@section('page-title','Edt Patient')
@section('page-description','Edit Patient')
@section('content')
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h5>Edit Patient</h5>
				<!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
			</div>
			<div class="card-block">
				<form id="ajax-form" class="form-material" data-ajax="update"
					  action="{{route('patients.update',$patient->id)}}" method="post">
					@csrf
					@method('patch')
				
					<div class="form-group form-default">
						<input id="first_name" type="text" name="first_name" class="form-control"
							   value="{{ $patient->first_name }}" required="">
						<span class="form-bar"></span>
						<label for="first_name" class="float-label">First Name</label>
					</div>
					
					<div class="form-group form-default">
						<input id="last_name" type="text" name="last_name" class="form-control"
							   value="{{ $patient->last_name }}" required="">
						<span class="form-bar"></span>
						<label for="last_name" class="float-label">Last Name</label>
					</div>
					
					<div class="form-group form-default">
						<input id="data_birth" type="text" name="data_birth" class="form-control"
							   data-provide="datepicker"
							   value="{{ $patient->date_birth->format('Y-m-d') }}" required="">
						<span class="form-bar"></span>
						<label for="data_birth" class="float-label">Date of Birth</label>
					</div>
					
					<div class="form-group form-default">
						<input id="sex" type="text" name="sex" class="form-control"
							   value="{{ $patient->sex }}" required="">
						<span class="form-bar"></span>
						<label for="sex" class="float-label">Sex</label>
					</div>
					
					<div class="form-group form-default">
						<input id="email" type="email" name="email" class="form-control"
							   value="{{ $patient->email }}" required="">
						<span class="form-bar"></span>
						<label for="email" class="float-label">Email</label>
					</div>
					
					<div class="form-group form-default">
						<input id="contact_number" type="text" name="contact_number" class="form-control"
							   value="{{ $patient->contact_number }}" required="">
						<span class="form-bar"></span>
						<label for="contact_number" class="float-label">Contact Number</label>
					</div>
					
					<div>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			
			</div>
		</div>
	</div>
@endsection