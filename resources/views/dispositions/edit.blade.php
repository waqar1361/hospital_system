@extends("layouts.app")
@section('page-title','Edit Disposition')
@section('page-description','Update a disposition or diagnosis')
@section('content')
    <style>
        .ck.ck-editor {
            box-shadow: 2px 2px 2px rgba(0, 0, 0, .1);
        }

        .ck.ck-content {
            font-size: 1em;
            line-height: 1.6em;
            margin-bottom: 0.8em;
            min-height: 200px;
            padding: 1em;
        }

        .pop {
            z-index: 5;
        }
    </style>
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Edit Disposition</h5>
            </div>
            <div class="card-block">

                <form id="ajax-form" class="form-material" action="{{ route('dispositions.update',$disposition->id) }}"
                      method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group form-default">

                        <label for="disposition">Diagnosis</label>
                        <h5>{{ $disposition->diagnosis }}</h5>
                        {{--<select name="diagnosis" id="disposition" class="dys">--}}
                        {{--@foreach($diagnoses as $diagnosis)--}}
                        {{--<option value="{{$diagnosis->id}}">{{ $diagnosis->diagnosis }}</option>--}}
                        {{--@endforeach--}}
                        {{--</select>--}}
                    </div>

                    <div class="form-group form-default">
                        <label for="diagnosis">Disposition</label>
                        <textarea id="diagnosis" name="disposition">{{$disposition->disposition}}</textarea>
                        <span class="form-bar"></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#diagnosis'), {}).then(editor => {
            window.editor = editor;
        }).catch(err => {
            console.error(err.stack);
        });


    </script>
    <script>
        $('select').dys();
    </script>
@endsection