@extends('admin.inc.main')
@section('content')
    <div class="content">
        @include('admin.inc.navbar')
        <div class="container-fluid pt-4 px-4">
            <div class="row bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 text-center">
                    <h3>QUESTIONS & OPTIONS</h3>
                </div>
                <div class="col-md-12 text-start">
                </div>
                <div class="row">
                    {{-- table --}}
                    <div id="show_data" class="col-sm-12 col-xl-8">
                        @include('admin.inc.table_question')
                    </div>
                    {{-- end table --}}
                    <div class="col-sm-12 col-xl-4">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4 text-center">ADD QUESTION & OPTIONS</h6>
                            <form method="POST" id="formAddQuestion">
                                @csrf
                                <select class="form-select mb-3" name="quiz_id" id="quiz_id"
                                    aria-label="Default select example" required>
                                    <option value="">Choose Quiz</option>
                                    @foreach ($quizs as $quiz)
                                        <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group">
                                    <textarea class="form-control" id="value_question" name="value_question" placeholder="Input question..."
                                        aria-label="With textarea" required></textarea>
                                </div>
                                <button style="width:100%; background-color:#2e80ff;border-radius:20px;margin-top:13px;"
                                    type="submit" id="buttonAddQuestion" class="btn btn-secondary">Add
                                    Question</button>
                            </form>
                            <form method="POST" id="formAddOption" class="mt-3" style="display:none">
                                <input type="hidden" name="_token" value="iBxN8pOPBflWZWLd7vtR6okgUKRfhgmjMAPqNuJG">
                                <div class="form-group">
                                    <input type="hidden" id="idQuestionn" name="idQuestionn">
                                    <label class="mb-2" for="exampleFormControlInput1">Add option</label>
                                    <textarea class="form-control" id="option" name="option" aria-label="With textarea" required=""></textarea>
                                    <div id="sms_unique_option" style="margin-top:10px;"></div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="isCorrect" name="isCorrect"
                                        value="1">
                                    <label class="form-check-label" for="isCorrect">If the answer is correct, please tick
                                        the box!</label>
                                </div>
                                <button id="submit-add-option"
                                    style="width: 100%; background-color: #2e80ff; display: none;" type="submit"
                                    class="btn btn-secondary">Add
                                    Option</button>
                            </form>
                            <button style="width:100%;background-color:#2e80ff; display:none;border-radius:20px;"
                                type="submit" id="buttonNewQuestion" class="btn btn-dark mt-3">Add New
                                Question</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    {{-- modal view --}}
    <!-- Modal -->
    <div class="modal fade" id="detailQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    {{-- end modal view --}}
    {{-- modal edit --}}
    <!-- Modal -->
    <div class="modal fade" id="editQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/question" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" id="idquestion">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="question " id="question" name="question" style="height: 150px;"
                                required></textarea>
                            <label for="question">Question</label>
                        </div>
                        <select id="quizcategory_id" name="quizcategory_id" class="form-select mb-3" required>
                            <option value="">Choose quiz</option>
                            @foreach ($quizs as $quiz)
                                <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary w-100 m-2" type="submit">UPDATE SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal edit --}}
    {{--  --}}
    <input type="hidden" id="question_id_open_modal_add_option">
    <div id="modal-container">
        <div class="modal-background">
            <div class="modal" style=" border-radius: 50px;width:60%">
                <div class="modal-title">
                    REPORT
                </div>
                <div class="options-content">

                </div>

            </div>
        </div>
    </div>

    {{-- end --}}
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $(".view-button").on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    datatype: "JSON",
                    url: '/admin/get-option/' + id,
                    success: function(result) {
                        $('#detailQuestion .modal-body').html(result);
                    },
                })
                $('#detailQuestion').modal('show');
            });
            $(".edit-button").on('click', function() {
                var id = $(this).data('id');
                $('#editQuestion').modal('show');
                $.ajax({
                    type: "GET",
                    datatype: "JSON",
                    url: '/admin/question/' + id,
                    success: function(result) {
                        $('#idquestion').val(result.id);
                        $('#question').val(result.question);
                        $('#quizcategory_id').val(result.quizcategory_id)
                    },
                })
            });
            $("#button-filter").on('click', function() {
                var quiz_id = $('#quizid').val();
                var filter = $('input[name=btnradio]:checked').attr('id');
                if (quiz_id == '') {
                    return window.location.href = "http://quizzeng.com/admin/question?filter=" + filter;
                }
                return window.location.href = "http://quizzeng.com/admin/question?quiz=" + quiz_id +
                    "&filter=" + filter;

            })


        });


        function deleteQuestion(id) {
            var result = confirm("Do you really want to delete it and all its options ? ");
            if (result != false) {
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '/admin/question/' + id + '/delete',
                    success: function(data) {

                        toastr.info('Wait!....');
                        window.setTimeout(function() {
                            window.location.reload();
                        }, 1000);

                    }
                })
            }
            return false;
        }

        function loadData() {
            $.ajax({
                type: "GET",
                datatype: "JSON",
                url: '/admin/question',
                success: function(result) {
                    $('#show_data').html(result);
                },
            })
        }
    </script>
    {{-- add question & option --}}
    <script>
        $('#submit-add-option').css('display', 'none');
        $('#formAddQuestion').on('submit', function(e) {
            e.preventDefault();
            var question = $('#value_question').val();
            var quizcategory_id = $('#quiz_id').val();
            $.ajax({
                type: "POST",
                datatype: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    question: question,
                    quizcategory_id: quizcategory_id
                },
                url: '/admin/add-question',
                success: function(result) {
                    if (result) {
                        $("#question").attr("disabled", "disabled");
                        $('#formAddOption').css('display', 'block');
                        $('#buttonAddQuestion').html('Add success.Please add options below!');
                        toastr.info('Add success.Please add options below!');
                        $('#buttonAddQuestion').removeClass('btn-secondary').addClass('btn-success');
                        $("#buttonAddQuestion").attr('disabled', true);
                        $("#idQuestionn").val(result.id);
                        loadData();
                    }
                },
            });
        })
        $('#option').keyup(function() {
            var idQuestion = $('#idQuestionn').val();
            var option = $(this).val();
            if (option == '') {
                $('#sms_unique_option').html('<p class="text-danger">Please enter answer</p>');
                $('#submit-add-option').css('display', 'none');
                return $('#buttonNewQuestion').css('display', 'none');
            }
            $.ajax({
                type: "POST",
                datatype: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    idQuestion: idQuestion,
                    option: option
                },
                url: '/admin/checkOptionUnique',
                success: function(result) {
                    if (result.rs == 'true') {
                        $('#sms_unique_option').html(
                            '<p class="text-danger">The answer already exists</p>');

                        $('#submit-add-option').css('display', 'none');
                        $('#buttonNewQuestion').css('display', 'none');
                    } else {
                        $('#sms_unique_option').html('<p class="text-success">The answer already</p>');
                        $('#submit-add-option').css('display', 'block');
                        $('#buttonNewQuestion').css('display', 'block');
                    }
                },
            });
        })
        $('#formAddOption').on('submit', function(e) {
            e.preventDefault();
            $('#sms_unique_option').html('');
            var idQuestion = $('#idQuestionn').val();
            var option = $('#option').val();
            var isCorrect = $("#isCorrect").is(':checked') ? isCorrect = $("#isCorrect").val() : 0;
            $.ajax({
                type: "POST",
                datatype: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    idQuestion: idQuestion,
                    option: option,
                    isCorrect: isCorrect
                },
                url: '/admin/add-option',
                success: function(result) {
                    $('#option').val('');
                    $('#buttonNewQuestion').css('display', 'block');
                    if (result.iscorrect == 1) {
                        $("#isCorrect").prop('checked', false);
                        $("#isCorrect").attr('disabled', true);
                    }
                    $('#formAddQuestion').append("<p class='show-option option-" + result.iscorrect +
                        "'>" + result.value + "</p>");
                },
            });
        })
        $('#buttonNewQuestion').on('click', function() {
            $('#value_question').val('');
            $(".show-option").remove();
            $("#question").removeAttr('disabled');
            $('#formAddOption').css('display', 'none');
            $('#buttonAddQuestion').html('Add Question');
            $('#buttonAddQuestion').removeClass('btn-success').addClass('btn-secondary');
            $("#buttonAddQuestion").attr('disabled', false);
            $("#idQuestionn").val('');
            $("#isCorrect").attr('disabled', false);
            $('#quiz_id').val('')
            $(this).css('display', 'none');
        })
    </script>
    <script>
        $('.options-buton').on('click', function() {
            var buttonID = $(this).attr('id');
            $("#modal-container").removeAttr("class").addClass(buttonID);
            var id = $(this).data('id');
            $('#question_id_open_modal_add_option').val(id);
            $.ajax({
                type: "GET",
                datatype: "JSON",
                url: '/admin/option/' + id + '/get',
                success: function(result) {
                    $('.options-content').html(result);
                    $('#button-add-row').on('click', function() {
                        $.ajax({
                            type: "GET",
                            datatype: "JSON",
                            url: '/admin/option/new',
                            success: function(result) {
                                $('.bodyTableOptions').append(result);
                                $('.submit_create-option').on('click', function(e) {
                                    e.preventDefault();
                                    var questionId = $(
                                            "#question_id_open_modal_add_option"
                                            )
                                        .val();
                                    var newOption = $("#ValueNewOption")
                                        .val();
                                    var iscorrect = $(
                                        "input[name='updateiscorrect']:checked"
                                    ).val();
                                    if (iscorrect == 'correct') {
                                        iscorrect = 1;
                                    } else {
                                        iscorrect = 0;
                                    }
                                    $.ajax({
                                        type: "POST",
                                        datatype: "JSON",
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]'
                                            ).attr(
                                                'content')
                                        },
                                        data: {
                                            idQuestion: questionId,
                                            option: newOption,
                                            isCorrect: iscorrect
                                        },
                                        url: `/admin/addOptionAndUpdate`,
                                        success: function(result) {
                                            loadTableOption(
                                                questionId);
                                            $('#button-add-row')
                                                .css('display',
                                                    'inline');
                                        },
                                    });


                                });
                            },
                        })
                    })
                },
            })
        })
    </script>

    @include('admin.inc.alert')
@endsection
