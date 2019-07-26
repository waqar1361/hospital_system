@extends("layouts.app")
@section('page-title','Edit treatment')
@section('page-description','Edt treatment')
@section('content')
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h5>Edit Treatment</h5>
				<!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
			</div>
			<div class="card-block">
				<form id="ajax-form" class="form-material" data-ajax="update"
					  action="{{ route('treatments.update',$treatment->id) }}" method="post">
					@csrf
					@method('patch')
					<div class="form-group form-default">
						<select name="type" class="form-control">
							<option selected disabled>Type</option>
							<option value="medicine" {{ $treatment->type == 'medicine' ? 'selected' : '' }}>Medicine</option>
							<option value="injection" {{ $treatment->type == 'injection' ? 'selected' : '' }}>Injection</option>
							<option value="therapy_typo"
									{{ $treatment->type == 'therapy_typo' ? 'selected' : '' }}>Therapy Typo</option>
						</select>
						<span class="form-bar"></span>
					</div>
					
					<div class="form-group form-default">
						<input id="name" type="text" name="name" class="form-control"
							   value="{{ $treatment->name }}" required="">
						<span class="form-bar"></span>
						<label for="name" class="float-label">Name</label>
					</div>
					
					<div class="form-group form-default">
						<input id="cost" type="text" name="cost" class="form-control"
							   value="{{ $treatment->cost }}" required="">
						<span class="form-bar"></span>
						<label for="cost" class="float-label">Cost</label>
					</div>
					
					<div>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			
			</div>
		</div>
	</div>
@endsection