@extends("layouts.app")
@section('page-title','Add new Patient')
@section('page-description','Create a new Patient')
@section('content')
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h5>Add Patient</h5>
				<!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
			</div>
			<div class="card-block">
				<form id="ajax-form" class="form-material" action="{{ route('patients.store') }}" method="post">
					@csrf

					<div class="form-group">
					<label class="custom-control custom-radio">
						<input id="radio1" name="type" value="emr" type="radio" class="custom-control-input" checked>
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">EMR</span>
					</label>
					<label class="custom-control custom-radio">
						<input id="radio2" name="type" value="tele_medicine" type="radio" class="custom-control-input">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Tele Medicine</span>
					</label>
					</div>

					<div class="form-group form-default form-static-label">
						<input id="mrn" type="text" name="mrn" class="form-control"
							   value="{{$mrn}}" readonly placeholder="MRN" >
						<span class="form-bar"></span>
						<label for="mrn" class="float-label">MRN</label>
					</div>
					
					<div class="form-group form-default">
						<input id="first_name" type="text" name="first_name" class="form-control" required="">
						<span class="form-bar"></span>
						<label for="first_name" class="float-label">First Name</label>
					</div>
					
					<div class="form-group form-default">
						<input id="last_name" type="text" name="last_name" class="form-control" required="">
						<span class="form-bar"></span>
						<label for="last_name" class="float-label">Last Name</label>
					</div>
					
					<div class="form-group form-default">
						<input id="date_birth" type="text" name="date_birth" class="form-control"
							   data-provide="datepicker" required="">
						<span class="form-bar"></span>
						<label for="date_birth" class="float-label">Date of Birth</label>
					</div>
					
					<div class="form-group form-default">
						<select name="sex" id="sex" class="form-control">
							<option value="male" selected>Male</option>
							<option value="female">Female</option>
							<option value="other">Not specified</option>
						</select>
						<span class="form-bar"></span>
						<label for="sex" class="float-label">Sex</label>
					</div>
					
					<div class="form-group form-default">
						<input id="email" type="email" name="email" class="form-control" required="">
						<span class="form-bar"></span>
						<label for="email" class="float-label">Email</label>
					</div>

					<div class="form-group form-default">
						<input id="contact_number" type="text" name="contact_number" class="form-control" required="">
						<span class="form-bar"></span>
						<label for="contact_number" class="float-label">Contact Number</label>
					</div>
					
					<div>
						<button type="reset" class="btn btn-danger">Reset</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>
@endsection