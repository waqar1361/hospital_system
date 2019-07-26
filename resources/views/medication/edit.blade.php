@extends("layouts.app")
@section('page-title','Edit medication')
@section('page-description','Update medication')
@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Update Medication</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form id="ajax-form" class="form-material" data-ajax="update"
                      action="{{ route('medications.update',$medication->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group form-default">
                        <select name="type" class="form-control">
                            <option selected disabled>Type</option>
                            <option value="medicine" {{ $medication->type == 'medicine' ? "selected" : '' }} >Medicine</option>
                            <option value="injection" {{ $medication->type == 'injection' ? "selected" : '' }} >Injection</option>
                            <option value="therapy_typo" {{ $medication->type == 'therapy_typo' ? "selected" : '' }} >Therapy
                                                                                                              Typo</option>
                        </select>
                        <span class="form-bar"></span>
                    </div>
                    
                    <div class="form-group form-default">
                        <input id="name" type="text" name="name" class="form-control"
                               value="{{ $medication->name }}" required="">
                        <span class="form-bar"></span>
                        <label for="name" class="float-label">Name</label>
                    </div>
                    
                    <div class="form-group form-default">
                        <input id="sig" type="text" name="sig" class="form-control"
                               value="{{ $medication->sig }}" required="">
                        <span class="form-bar"></span>
                        <label for="sig" class="float-label">SIG</label>
                    </div>
                    
                    <div class="form-group form-default">
                        <input id="dispense" type="text" name="dispense" class="form-control"
                               value="{{$medication->dispense}}" required="">
                        <span class="form-bar"></span>
                        <label for="dispense" class="float-label">Dispense</label>
                    </div>
                    
                    <div class="form-group form-default">
                        <input id="refill" type="text" name="refill" class="form-control"
                               value="{{ $medication->refill }}" required="">
                        <span class="form-bar"></span>
                        <label for="refill" class="float-label">Refill</label>
                    </div>

                    <div class="form-group form-default">
                        <input id="cost" type="text" name="cost" class="form-control"
                               value="{{ $medication->cost }}" required="">
                        <span class="form-bar"></span>
                        <label for="cost" class="float-label">Price</label>
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