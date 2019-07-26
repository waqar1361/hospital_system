@extends("layouts.app")
@section('page-title','Edit Diagnosis')
@section('page-description','Change disposition, diagnosis')
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
                <h5>Edit Diagnosis</h5>
            </div>
            <div class="card-block">
                <form id="ajax-form" class="form-material" data-ajax="update"
                      action="{{ route('diagnosis.update',$disposition->id) }}" method="post">
                    @csrf
                    @method('patch')

                    <div class="form-group form-default">
                        <input id="name" type="text" name="name" class="form-control"
                               value="{{ $disposition->diagnosis }}" required="">
                        <span class="form-bar"></span>
                        <label for="name" class="float-label">Diagnosis</label>
                    </div>


                    {{--<div class="form-group form-default">--}}
                        {{--<textarea id="diagnosis" name="diagnosis" class="form-control"--}}
                                  {{-->{{ $disposition->disposition }}</textarea>--}}
                    {{--</div>--}}

                    <div class="text-right">
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