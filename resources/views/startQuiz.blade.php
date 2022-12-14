@extends('main')
@section('content')
    <div class="main">
        <div class="container" id="show_content">
            @include('breadcumb')
            <div class="text_heading">{{ $title }}</div>
            <div id="score" style="padding:20px 0; font-size:20px;text-align:center;font-weight:700;"></div>
            <div class="question-cat">
                Choose the best option in the following sentence.
            </div>
            <div class="start_quizz">
                <form action="">
                    <div class="list_quizz">
                        <div class="item">
                            <div class=" question-title">
                                {{ $listQuestion[0]['question'] }}

                            </div>
                            <div class="answer">
                                @php
                                    $numal = 0;
                                    $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                                @endphp

                                @foreach ($listQuestion[0]['options'] as $option)
                                    @php
                                        $a = $listQuestion[0]['id'];
                                    @endphp
                                    <div class="radiobtn">
                                        <input onclick="optionClick({{ $listQuestion[0]['id'] }},{{ $option['id'] }})"
                                            type="radio" id="{{ $option['id'] }}" name="answer"
                                            value="{{ $option['id'] }}" @if (session()->get("answer.$a") == $option['id']) checked @endif />
                                        <label for="{{ $option['id'] }}">
                                            {{ $alphabet[$numal] }}. {{ $option['value'] }}
                                        </label>
                                    </div>
                                    @php
                                        $numal++;
                                    @endphp
                                @endforeach


                            </div>
                        </div>
                    </div>
                </form>
                <div class="question">
                    <div class="d-flex" id="wp-countdown">
                        <i class="fas fa-clock mr-3" style="font-size: 20px"></i>
                        <div class="timeCountDown" data-time="{{ $time }}"
                            data-id="{{ $listQuestion[0]['quizcategories']['id'] }}"></div>

                    </div>
                    <div class="head">Questions</div>
                    <div class="question_item">
                        @if (count($listQuestion) > 0)
                            @php
                                $ntt = 0;
                                
                            @endphp
                            @foreach ($listQuestion as $item)
                                @php
                                    $ntt++;
                                @endphp
                                <button style="border:none;" data-id="{{ $item['id'] }}" class="box ButtonQuestion ">
                                    {{ $ntt }}
                                </button>
                            @endforeach
                        @else
                        @endif
                    </div>
                    <button type="submit" class="submit_question"
                        onclick="redirect_result({{ $listQuestion[0]['quizcategories']['id'] }})">Submit</button>
                </div>
            </div>
        </div>
        <div class="container text-center" style="display:none; margin-top: 35px;" id="subResult">
            <a href="{{ route('member.myquiz') }}" class="btn"
                style=" padding: 15px 20px; background-color: tomato; color: white">Back</a>
            <a href="{{ $_SERVER['REQUEST_URI'] }}" class="btn btn-info"
                style=" padding: 15px 20px; background-color: var(--blue);">Try Again</a>
            <button type="button" id="two" class="btn btn-danger button-mdal">Report
            </button>
        </div>
    </div>

    <div id="modal-container">
        <div class="modal-background">
            <div class="modal" style=" border-radius: 50px;">
                <div class="modal-title">
                    REPORT
                </div>
                <div class="report-content">
                    <form method="POST" id="form-report">
                        @csrf
                        <select id="type_error" name="type_error" class="form-control" required>
                            @foreach (config('constants.error_report') as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <textarea class="form-control" id="content" name="content" rows="7" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Send Report</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            const startingMinutes = $('.timeCountDown').data('time');
            let time = startingMinutes * 60;
            setInterval(updateCountDown, 1000);

            function updateCountDown() {
                const minutes = Math.floor(time / 60);
                let seconds = time % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                $('.timeCountDown').html(`${minutes}: ${seconds}`);
                if (minutes == 0 && seconds <= 10) {
                    $('.timeCountDown').css('color', 'red');
                }
                if (minutes == 0 && seconds == 00) {
                    var id = $('.timeCountDown').data('id');
                    redirect_result(id);
                }
                time--;
            }
        })
    </script>
    <script>
        $('.ButtonQuestion').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: '/get-question/' + id,
                success: function(data) {
                    $('.question-title').html(data.question);
                    $('.answer').html(data.html);
                }
            })
        })

        function optionClick(questionid, optionid) {
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "/ajax/save_answer_insesion/" + optionid + "/" + questionid,
                success: function(data) {
                    if (data.stt == 'add') {
                        $('button[data-id="' + questionid + '"]').addClass('active-item');
                    } else {
                        $('button[data-id="' + questionid + '"]').removeClass('active-item');
                        $('#' + optionid + '').prop('checked', false);
                    }
                }

            })
        }
    </script>
    <script>
        function redirect_result(id) {
            $('.submit_question').attr('disabled', true);
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "/result",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(data) {
                    $('#subResult').css('display', 'block');
                    $('.start_quizz').remove();
                    $('.question-cat').remove();
                    $('#show_content').append(data.data);
                    $('#score').html(data.score);
                }

            })
        }
    </script>
    {{-- send report --}}
    <script>
        $("#form-report").submit(function(event) {
            event.preventDefault();
            var type_error = $('#type_error').val();
            var content = $('#content').val();
            $.ajax({
                type: "POST",
                dataType: "JSON",
                data: {
                    type_error: type_error,
                    content: content
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': '/storeReport',
                success: function(rs) {
                    if (rs.type == 'success') {
                        $(this).closest('form').find("input[type=text], textarea").val("");
                        $("#modal-container").addClass("out");
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        };
                        toastr.success(rs.msg);
                    } else if (rs.type == 'error') {
                        toastr.error(rs.msg);
                    }
                }
            })
        });
    </script>
@endsection
