@extends("layouts.app")
@section('page-title','Add new treatment')
@section('page-description','Create a new treatment')
@section('content')
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h5>Add Treatment</h5>
				<!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
			</div>
			<div class="card-block">
				<form id="ajax-form" class="form-material" action="{{ route('treatments.store') }}" method="post">
					@csrf
					
					<div class="form-group form-default">
						<select name="type" class="form-control">
							<option selected disabled>Type</option>
							<option value="medicine">Medicine</option>
							<option value="injection">Injection</option>
							<option value="therapy_typo">Therapy Typo</option>
						</select>
						<span class="form-bar"></span>
					</div>
					
					<div class="form-group form-default">
						<input id="name" type="text" name="name" class="form-control" required="">
						<span class="form-bar"></span>
						<label for="name" class="float-label">Name</label>
					</div>
					
					<div class="form-group form-default">
						<input id="cost" type="text" name="cost" class="form-control" required="">
						<span class="form-bar"></span>
						<label for="cost" class="float-label">Cost</label>
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