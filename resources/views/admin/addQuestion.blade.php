@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            <div class="add_question mt-0" style="">
                <div class="">
                    <div class="row" style="padding: 0 10px;">
                        @include('breadcumb')
                    </div>
                </div>
                <br>
                @include('alert')
                <div class="text_head" style="font-size: 45px">{{ $cat->name }}</div>
                <div class=" mt-5">
                    <div class="row">
                        <div class="col-md-8 border-right">
                            <table id="tableQuestion" class="table" data-id={{ $cat->id }}>
                                <thead class="">
                                    <tr style="font-size: 22px; background-color: #F6FAFF;">
                                        <th scope="col">#</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="loadData">
                                    <tr>
                                        <th colspan="3">
                                            <div class="loader loader--style3 text-center" title="2">
                                                <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="40px" height="40px" viewBox="0 0 50 50"
                                                    style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                    <path fill="#000"
                                                        d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                                        <animateTransform attributeType="xml" attributeName="transform"
                                                            type="rotate" from="0 25 25" to="360 25 25" dur="0.6s"
                                                            repeatCount="indefinite" />
                                                    </path>
                                                </svg>
                                            </div>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="text_head text-center"
                                style="font-size: 22px;background-color: #F6FAFF;padding: 15px;border: 1px solid #ADADAD;border-radius:10px;">
                                Add question for {{ $cat->name }}
                            </div>
                            <form method="POST" id="formAddQuestion">
                                @csrf
                                <div class="input-group">

                                    <input type="hidden" id="quizcategory_id" name="quizcategory_id"
                                        value="{{ $cat->id }}">
                                    <textarea class="form-control" id="question" name="question" placeholder="Input question..." aria-label="With textarea"
                                        required></textarea>
                                </div>
                                <button style="width:100%; background-color:var(--blue);border-radius:20px;margin-top:13px;"
                                    type="submit" id="buttonAddQuestion" class="btn btn-secondary">Add
                                    Question</button>
                            </form>
                            <form method="POST" id="formAddOption" class="mt-3" style="display:none">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" id="idQuestion" name="idQuestion">
                                    <label class="mb-2" for="exampleFormControlInput1">Add option</label>
                                    <textarea class="form-control" id="option" name="option" aria-label="With textarea" required></textarea>
                                    <div id="sms_unique_option" style="margin-top:10px;"></div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="isCorrect" name="isCorrect"
                                        value="1">
                                    <label class="form-check-label" for="isCorrect">If the answer is correct, please tick
                                        the box!</label>
                                </div>
                                <button id="submit-add-option" style="width:100%;  background-color:var(--blue); margin-top: 15px;"
                                    type="submit" class="btn btn-secondary">Add
                                    Option</button>
                            </form>
                            <button style="width:100%;background-color:var(--blue); display:none;border-radius:20px;"
                                type="submit" id="buttonNewQuestion" class="btn btn-dark mt-3">Add New
                                Question</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="showQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="    background: var(--background);">
                <div class="modal-header" style="background-color:var(--blue);font-size:25px;color:var(--white);">
                    <h5 class="modal-edit-title" id="exampleModalCenterTitle">Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Illo
                        exercitationem
                        modi facere, quibusdam
                        quasi vel?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background: var(--white);">
                    <div class="reviewListQuestion" style="font-size:20px">

                    </div>
                    <button type="button" style="border-radius:20px;" class="btn btn-secondary float-right"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal edit Option -->
    <div class="modal fade" id="editOption" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="width:auto; background: var(--background);">
                <div class="modal-header" style="background-color:var(--blue);font-size:25px;color:var(--white);">
                    <h5 class="modal-edit-title titleModalEdit" id="exampleModalCenterTitle">Lorem ipsum dolor sit amet
                        consectetur
                        adipisicing elit. Illo
                        exercitationem
                        modi facere, quibusdam
                        quasi vel?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Option</th>
                                <th scope="col">Correct?</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bodyTableOption">


                        </tbody>
                    </table>
                    <button type="button" style="border-radius:20px;" class="btn btn-success" id="button-add-row">Add
                        option</button>
                    <button type="button" style="border-radius:20px;" class="btn btn-secondary float-right"
                        data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            loadData();
        });
        // show modal question
        $(document).on('click', '.buttonShowQuestion', function(e) {
            $('#showQuestion').modal();
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                datatype: "JSON",
                url: '/admin/get-option/' + id,
                success: function(result) {

                    var bullets = 'abcdefghijklmnopqrstuvwxyz'.toUpperCase().split('');
                    var html = "";
                    var count = 0;
                    $.each(result, function(k, v) {
                        $('.modal-edit-title').html(v.question.question);
                        html += '<p class="pb-2">';
                        html += `<span>${bullets[count]}. </span>`;
                        html += `${v.value}`;
                        if (v.iscorrect == 0) {
                            html += ' <i class="fa-solid fa-xmark  text-danger"></i>';
                        } else {
                            html += ' <i class="fa-solid fa-circle-check text-success"></i>';
                        }
                        html += '</p>';
                        count++;
                    });
                    $('.reviewListQuestion').html(html);
                },
            })
        });
        // show modal edit option
        $(document).on('click', '.buttonEditOption', function(e) {
            $('#editOption').modal();
            var question_name = $(this).data('name');
            $('.titleModalEdit').html(question_name);
            var id = $(this).data('id');
            loadTableOption(id);
        });

        $(document).on('click', '.deleteQuestion', function(e) {
            e.preventDefault();
            var id = $(this).data('optitonid');
            var questionID = $(this).data('questionid');
            $.ajax({
                type: "GET",
                datatype: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                url: `/admin/option/${id}/delete`,
                success: function(result) {
                    loadTableOption(questionID);
                },
            });


        });

        $(document).on('click', '.submit_create-option', function(e) {
            e.preventDefault();
            var questionId = $(".updateOption").data('questionid');
            var newOption = $("#ValueNewOption").val();
            var iscorrect = $("input[name='updateiscorrect']:checked").val();
            if (iscorrect == 'correct') {
                iscorrect = 1;
            } else {
                iscorrect = 0;
            }
            $.ajax({
                type: "POST",
                datatype: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    idQuestion: questionId,
                    option: newOption,
                    isCorrect: iscorrect
                },
                url: `/admin/addOptionAndUpdate`,
                success: function(result) {
                    loadTableOption(questionId);
                    $('#button-add-row').css('display', 'inline');
                },
            });


        });
        $(document).on('click', '.updateOption', function(e) {
            e.preventDefault();
            var question_id = $(this).data('questionid');
            var option_id = $(this).data('optitonid');
            var option_value = $('.option-' + option_id).val();
            var iscorrect = $("input[name='updateiscorrect']:checked").val();
            if (iscorrect == option_id) {
                iscorrect = 1;
            } else {
                iscorrect = 0;
            }
            $.ajax({
                type: "POST",
                datatype: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    idQuestion: question_id,
                    idOption: option_id,
                    option: option_value,
                    isCorrect: iscorrect
                },
                url: `/admin/UpdateOption`,
                success: function(result) {
                    loadTableOption(question_id);
                    $('#button-add-row').css('display', 'inline');
                },
            });
        })


        function loadData() {
            var idCat = $('#tableQuestion').data('id');
            $.ajax({
                type: "GET",
                datatype: "JSON",
                url: '/admin/ListQuizTest/' + idCat,
                success: function(result) {
                    var html = '';
                    if (result != null) {
                        var num = 0;
                        $.each(result, function(k, v) {
                            num++;
                            html += '<tr style="font-size: 20px;">';
                            html += `<th scope="row">${num}</th>`;
                            html += `<td>${v.question}</td>`;
                            html +=
                                `<td style=""> <a href="#showQuestion" data-id="${v.id}" class="buttonShowQuestion mr-3"><i class="fa-solid fa-eye"></i></a>`;
                            html += `<a data-id="${v.id}" data-name="${v.question}" href="#editOption" class="buttonEditOption button-edit mr-3"><i
                                         class="fa-solid fa-pen-to-square"></i></a>`;
                            html += `<a href="/admin/question/${v.id}/delete"
                                                        onclick="confirm('Are you sure?')"><i
                                                            class="text-danger fa-solid fa-trash-can"></i></a>`;
                            html += `</td>`;
                            html += `< /tr >`;

                        });
                    } else {
                        html += '<tr>';
                        html += '    <th colspan="3">No data</th>';
                        html += ' </tr>';
                    }
                    $('.loadData').html(html);

                },
            })

        }

        function loadTableOption(id) {
            var result = '';
            var num = 0;
            $.ajax({
                type: "GET",
                datatype: "JSON",
                url: '/admin/get-option/' + id,
                success: function(result) {
                    $.each(result, function(k, v) {
                        $('.modal-edit-title').html(v.question.question);
                        num++;
                        result += '<tr>';
                        result += `<th scope="row">${num}</th>`;
                        result += `<td>`;
                        result +=
                            `<textarea rows="2" cols="50" style=" color:var(--black);" name="" id="" class="textarea-edit-option option-${v.id}" required>${v.value}</textarea>`;
                        result += `</td>`;
                        result +=
                            `<td class="text-center"> <input class="form-check-input" type="radio" name="updateiscorrect" id="exampleRadios1" value="${v.id}"`;
                        if (v.iscorrect == 1) {
                            result += 'checked';
                        }
                        result += `>`;
                        result += `</td>`;
                        result += `<td class="text-center">`;
                        result +=
                            `<a href="#" class="updateOption" data-questionId= ${v.question.id} data-optitonId="${v.id}"><i class=" text-success fa-solid fa-check mr-3 "></i></a>
                            <a href="#" class="deleteQuestion" data-questionId= ${v.question.id} data-optitonId="${v.id}"><i class=" text-danger fas fa-trash-alt"></i></a>`;
                        result += `</td>`;
                        result += `</tr>`;
                    });

                    $('.bodyTableOption').html(result);
                },
            })
        }
    </script>
    <script>
        $('#submit-add-option').css('display', 'none');
        $('#formAddQuestion').on('submit', function(e) {
            e.preventDefault();
            var quizcategory_id = $('#quizcategory_id').val();
            var question = $('#question').val();
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
                        $('#buttonAddQuestion').removeClass('btn-secondary').addClass('btn-success');
                        $("#buttonAddQuestion").attr('disabled', true);
                        $("#idQuestion").val(result.id);
                        loadData();
                    }
                },
            });
        })
        $('#option').keyup(function() {
            var idQuestion = $('#idQuestion').val();
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
            var idQuestion = $('#idQuestion').val();
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
            $('#question').val('');
            $(".show-option").remove();
            $("#question").removeAttr('disabled');
            $('#formAddOption').css('display', 'none');
            $('#buttonAddQuestion').html('Add Question');
            $('#buttonAddQuestion').removeClass('btn-success').addClass('btn-secondary');
            $("#buttonAddQuestion").attr('disabled', false);
            $("#idQuestion").val('');
            $("#isCorrect").attr('disabled', false);
            $(this).css('display', 'none');
        })
        $('#button-add-row').on('click', function() {
            html = '';
            html += '<tr>';
            html += '<th scope="row"><input type="text" style="width:26px;" placeholder="id" disabled/></th>';
            html +=
                '<td><textarea class="textarea-edit-option" name="ValueNewOption" id="ValueNewOption" cols="38" rows="2" required></textarea></td>';
            html +=
                '<td class="text-center"><input type="radio" class="form-check-input" name="updateiscorrect" value="correct" /></td>';
            html += '<td class="text-center">';
            html +=
                '<button class="submit_create-option custom-btn btn-5" style="border-radius:20px;"><span>Create <i class="fa-solid fa-circle-plus"></i></span></button></td>';
            html += '</tr>';
            $(".bodyTableOption").append(html);
            $(this).css('display', 'none');
        })
    </script>
@endsection
