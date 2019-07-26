@extends("layouts.auth")

@section('content')
    <style>
        .chat-area {
            max-height: 60vh;
            min-height: 50vh;
            overflow-y: scroll;
        }

    </style>
    <div class="container">
        <div class="card">
            <div class="card-block">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#ChatTab" role="tab">Chat</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#VideoTab" role="tab">Video</a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="ChatTab" role="tabpanel">

                        <div class="chat-area form-group">
                            @foreach($messages as $message)
                                <div class="card mb-1">
                                    <div class="p-2
                                    {{ $message->sender == 'patient' ? 'text-dark' : '' }}
                                    {{ $message->sender == 'doctor' ? 'text-primary' : '' }}
                                    {{ $message->sender == 'nurse' ? 'text-danger' : '' }}
                                            ">
                                        <b>{{ $message->sender == 'patient' ? $patient->fullname : $message->sender }}
                                            :</b>
                                        {{ $message->messages }}
                                        <span class="pull-right">{{ $message->created_at }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-row form-material">
                            <div class="form-group form-primary col-10">
                                <input type="text" id="message" name="footer-email" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Type Here</label>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary btn-block"
                                        id="send-btn"
                                        type="button">
                                    <i class="fa fa-send"></i>
                                    Send
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="VideoTab" role="tabpanel">

                        <iframe width="90%" height="500px" src="//appr.tc/r/{{ $patient->id }}"
                                allow="geolocation; microphone; camera"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var currentCount = {{ $count }}, patientID = {{ $patient->id }}, MRN = {{ $patient->mrn }};

        function checkCountMessages() {
            $.ajax({
                url: '{{ url()->current() }}',
                type: "post",
                data: {
                    count: currentCount,
                    patient_id: {{ $patient->id }},
                },
                dataType: 'json',
                success: function (response) {
                    if (response.received == true) {
                        currentCount++;
                        $('.chat-area').append(response.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }

        function sendMessage() {
            let $message = $('#message');
            currentCount++;
            let message = $message.val();
            $.ajax({
                url: '{{ route('conversations.store') }}',
                type: "post",
                data: {
                    messages: message,
                    patient_id: patientID,
                    sender: 'patient',
                    sender_id: MRN,
                },
                success: function (response) {
                    $('.chat-area').append(response);
                    $message.val('');
                    var n = $('.card').height();
                    $('.chat-area').animate({scrollTop: n}, 50);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }

        $('#send-btn').on('click', function (event) {
            event.preventDefault();
            sendMessage();
        });

        $('#message').on("keyup", function (event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                sendMessage();
            }
        });

        $(document).ready(function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            var n = $('.card').height();
            $('.chat-area').animate({scrollTop: n}, 50);
            setInterval(function () {
                checkCountMessages();
            }, 1000);
        });
    </script>
@endpush