@extends("layouts.app")
@section('page-title','Add new user')
@section('page-description','Create a new user')
@section('content')
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h5>Add User</h5>
				<!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
			</div>
			<div class="card-block">
			<form id="ajax-form" class="form-material" action="{{route('users.store')}}" method="post">
				@csrf
				
				<div class="form-group form-default">
					<select name="type" class="form-control" id="type">
						<option selected disabled>Type</option>
						<option value="admin">Admin</option>
						<option value="doctor">Doctor</option>
						<option value="nurse">Nurse</option>
						<option value="lab_tech">Lab Tech</option>
						<option value="biller">Biller</option>
						<option value="clerk">Clerk</option>
					</select>
					<span class="form-bar"></span>
					<label for="type" class="float-label">Type</label>
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
					<input id="email" type="email" name="email" class="form-control" required="">
					<span class="form-bar"></span>
					<label for="email" class="float-label">Email</label>
				</div>
				
				<div class="form-group form-default">
					<input id="password" type="password" name="password" class="form-control" required="">
					<span class="form-bar"></span>
					<label for="password" class="float-label">Password</label>
				</div>
				
				<div class="form-group form-default">
					<input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required="">
					<span class="form-bar"></span>
					<label for="password_confirmation" class="float-label">Password Confirm</label>
				</div>
				
				<div class="form-group form-default">
					<input id="salary" type="text" name="salary" class="form-control" required="">
					<span class="form-bar"></span>
					<label for="salary" class="float-label">Salary</label>
				</div>
				
				<div class="form-group form-default">
					<input id="lic-no" type="text" name="lic_no" class="form-control" required="">
					<span class="form-bar"></span>
					<label for="lic-no" class="float-label">Lic. No</label>
				</div>
				
				<div class="form-group form-default">
					<textarea id="address" name="address" class="form-control" required=""></textarea>
					<span class="form-bar"></span>
					<label for="address" class="float-label">Address</label>
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