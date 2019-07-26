@extends("layouts.app")
@section('page-title','Add new Diagnosis')
@section('page-description','Create a diagnosis')
@section('content')
    {{--<style>--}}
        {{--.ck.ck-editor {--}}
            {{--box-shadow: 2px 2px 2px rgba(0, 0, 0, .1);--}}
        {{--}--}}

        {{--.ck.ck-content {--}}
            {{--font-size: 1em;--}}
            {{--line-height: 1.6em;--}}
            {{--margin-bottom: 0.8em;--}}
            {{--min-height: 200px;--}}
            {{--padding: 1em;--}}
        {{--}--}}
    {{--</style>--}}
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Add Diagnosis</h5>
            </div>
            <div class="card-block">

                <form id="ajax-form" class="form-material" action="{{ route('diagnosis.store') }}" method="post">
                    @csrf

                    <div class="form-group form-default w-100">
                        <input id="name" type="text" name="diagnosis" class="form-control"
                               required="">
                        <span class="form-bar"></span>
                        <label for="name" class="float-label">Diagnosis Name</label>
                    </div>

                    {{--<div class="form-group form-default">--}}
                        {{--<label for="diagnosis" >Disposition [optional]</label>--}}
                        {{--<textarea id="diagnosis" name="diagnosis"></textarea>--}}
                        {{--<span class="form-bar"></span>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

{{--@section('page-script')--}}
    {{--<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>--}}
    {{--<script>--}}
        {{--ClassicEditor--}}
            {{--.create(document.querySelector('#diagnosis'), {})--}}
            {{--.then(editor => {--}}
                {{--window.editor = editor;--}}
            {{--})--}}
            {{--.catch(err => {--}}
                {{--console.error(err.stack);--}}
            {{--});--}}
    {{--</script>--}}
{{--@endsection--}}