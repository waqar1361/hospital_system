@extends("layouts.app")
@section('page-title','User')
@section('page-description','Edit user')
@section('content')
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h5>Edit User</h5>
				<!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
			</div>
			<div class="card-block">
				<form id="ajax-form" class="form-material" data-ajax="update"
					  action="{{route('users.update',$user->id)}}" method="post">
					@csrf
					@method('patch')
					<div class="form-group form-default">
						<select name="type" class="form-control" id="type">
							<option selected disabled>Type</option>
							<option value="admin" {{ $user->type == 'admin' ? "selected" : '' }}>Admin</option>
							<option value="doctor" {{ $user->type == 'doctor' ? "selected" : '' }}>Doctor</option>
							<option value=nurse" {{ $user->type == 'nurse' ? "selected" : '' }}>Nurse</option>
							<option value="lab_tech" {{ $user->type == 'lab_tech' ? "selected" : '' }}>Lab Tech</option>
							<option value="biller" {{ $user->type == 'biller' ? "selected" : '' }}>Biller</option>
							<option value="clerk" {{ $user->type == 'clerk' ? "selected" : '' }}>Clerk</option>
						</select>
						<span class="form-bar"></span>
						<label for="type" class="float-label">Type</label>
					</div>
					
					<div class="form-group form-default">
						<input id="first_name" type="text" name="first_name" class="form-control"
							   value="{{ $user->first_name }}" required="">
						<span class="form-bar"></span>
						<label for="first_name" class="float-label">First Name</label>
					</div>
					
					<div class="form-group form-default">
						<input id="last_name" type="text" name="last_name" class="form-control"
							   value="{{ $user->last_name }}" required="">
						<span class="form-bar"></span>
						<label for="last_name" class="float-label">Last Name</label>
					</div>
					
					<div class="form-group form-default">
						<input id="date_birth" type="text" name="date_birth" class="form-control"
							   value="{{ $user->date_birth }}" required="">
						<span class="form-bar"></span>
						<label for="date_birth" class="float-label">Date of Birth</label>
					</div>
					
					
					<div class="form-group form-default">
						<input id="email" type="email" name="email" class="form-control"
							   value="{{ $user->email }}" required="">
						<span class="form-bar"></span>
						<label for="email" class="float-label">Email</label>
					</div>
					
					<div class="form-group form-default">
						<input id="password" type="password" name="password" class="form-control">
						<span class="form-bar"></span>
						<label for="password" class="float-label">Password</label>
					</div>
					
					<div class="form-group form-default">
						<input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
						<span class="form-bar"></span>
						<label for="password_confirmation" class="float-label">Password Confirm</label>
					</div>
					
					<div class="form-group form-default">
						<input id="salary" type="text" name="salary" class="form-control"
							   value="{{ $user->salary }}" required="">
						<span class="form-bar"></span>
						<label for="salary" class="float-label">Salary</label>
					</div>
					
					<div class="form-group form-default">
						<input id="lic-no" type="text" name="lic_no" class="form-control"
							   value="{{ $user->lic_no }}" required="">
						<span class="form-bar"></span>
						<label for="lic-no" class="float-label">Lic. No</label>
					</div>
					
					<div class="form-group form-default">
						<textarea id="address" name="address" class="form-control" required="">{{ $user->address }}</textarea>
						<span class="form-bar"></span>
						<label for="address" class="float-label">Address</label>
					</div>
					
					<div>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			
			</div>
		</div>
	</div>
@endsection