@extends('admin.inc.main')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main user-member justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Question & Option</h4>
                            </div>
                        </div>
                        <div class="action-btn">
                            <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#new-member">
                                <i class="las la-plus fs-16"></i>Add New Question</a>

                            <!-- Modal -->
                            <div class="modal fade new-member" id="new-member" role="dialog" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content  radius-xl">
                                        <div class="modal-header">
                                            <h6 class="modal-title fw-500" id="staticBackdropLabel">Create new question</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18">
                                                    </line>
                                                    <line x1="6" y1="6" x2="18" y2="18">
                                                    </line>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="new-member-modal">
                                                <form id="formAddQuestion" method="POST">
                                                    @csrf
                                                    <div class="form-group mb-20">
                                                        <div class="category-member">
                                                            <select
                                                                class="js-example-basic-single js-states form-control mb-3"
                                                                name="quiz_id" id="quiz_id"
                                                                aria-label="Default select example" required>
                                                                <option class="optionDefault" value="0">Choose Quiz
                                                                </option>
                                                                @foreach ($quizs as $quiz)
                                                                    <option value="{{ $quiz->id }}">{{ $quiz->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <textarea class="form-control" id="value_question" name="value_question" placeholder="Input question..."
                                                            aria-label="With textarea" required></textarea>
                                                    </div>
                                                    <div class="button-group d-flex pt-25">
                                                        <button type="submit" id="buttonAddQuestion"
                                                            class="btn btn-primary btn-default btn-squared text-capitalize">add
                                                            new project
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->


                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="card">
                        <div class="card-header color-dark fw-500">
                            Question List
                        </div>
                        <div class="card-body">
                            <div class="userDatatable projectDatatable project-table bg-white w-100 border-0">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr class="userDatatable-header">
                                                <th class="text-center col-3">
                                                    <span class="projectDatatable-title">Category</span>
                                                </th>
                                                <th class="text-center col-6">
                                                    <span class="projectDatatable-title">Question</span>
                                                </th>
                                                <th class="text-center col-1">
                                                    <span class="projectDatatable-title">Options</span>
                                                </th>
                                                <th class="text-center col-2">
                                                    <span class="projectDatatable-title">Action</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $item)
                                                    <tr>
                                                        <td class="text-center">
                                                            <div class="userDatatable-content">{{ $item->name }} </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="userDatatable-content"> {!! html_entity_decode($item->question) !!}
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="userDatatable-content">{{ count($item->options) }}
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <ul
                                                                class="orderDatatable_actions justify-content-center mb-0 d-flex flex-wrap">
                                                                <li>
                                                                    <a href="#" class="view view-button"
                                                                        data-id="{{ $item->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-eye">
                                                                            <path
                                                                                d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                            </path>
                                                                            <circle cx="12" cy="12"
                                                                                r="3"></circle>
                                                                        </svg></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="edit edit-button"
                                                                        data-id="{{ $item->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-edit">
                                                                            <path
                                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                            </path>
                                                                            <path
                                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                            </path>
                                                                        </svg></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" data-id="{{ $item->id }}"
                                                                        class="remove delete-button">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-trash-2">
                                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                                            <path
                                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                            </path>
                                                                            <line x1="10" y1="11"
                                                                                x2="10" y2="17"></line>
                                                                            <line x1="14" y1="11"
                                                                                x2="14" y2="17"></line>
                                                                        </svg></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <th colspan="4"> No data found</th>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table><!-- End: .table -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="user-pagination">
                                                <div class="d-flex justify-content-sm-end justify-content-end mt-1 mb-30">
                                                    {{ $data->links() }}
                                                </div>
                                                <!-- End of Pagination-->
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div><!-- End: .userDatatable -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- modal view --}}
    <!-- Modal -->
    <div class="modal fade new-member" id="detailQuestion" role="dialog" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content  radius-xl">
                <div class="modal-header">
                    <h6 class="modal-title fw-500" id="staticBackdropLabel">Detail Question</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18">
                            </line>
                            <line x1="6" y1="6" x2="18" y2="18">
                            </line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="new-member-modal">
                        <form>
                            <div class="button-group d-flex pt-25">
                                <button class="btn btn-primary btn-default btn-squared text-capitalize">add
                                    new project
                                </button>
                                <button
                                    class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light">cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- end modal view --}}
    {{-- modal edit --}}
    <!-- Modal -->
    <div class="modal fade new-member" id="editQuestion" role="dialog" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content  radius-xl">
                <div class="modal-header">
                    <h6 class="modal-title fw-500" id="staticBackdropLabel">Edit Quiz</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18">
                            </line>
                            <line x1="6" y1="6" x2="18" y2="18">
                            </line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="new-member-modal">
                        <form action="/admin/question" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" id="idquestion">
                            <div class="form-group mb-20">
                                <div class="category-member">
                                    <select id="quizcategory_id" name="quizcategory_id"
                                        class="js-example-basic-single form-control js-states mb-3" required>
                                        <option value="">Choose quiz</option>
                                        @foreach ($quizs as $quiz)
                                            <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-20">
                                <textarea class="form-control" placeholder="question " id="question" name="question" style="height: 150px;"
                                    required></textarea>
                            </div>
                            <div class="button-group d-flex pt-25">
                                <button class="btn btn-primary btn-default btn-squared text-capitalize">Update
                                </button>
                                <button
                                    class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light">cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal edit --}}
    {{-- ádasd --}}
    <div class="modal fade" id="addOptions" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Add options</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formAddOption" class="mt-3">
                        <input type="hidden" name="_token" value="iBxN8pOPBflWZWLd7vtR6okgUKRfhgmjMAPqNuJG">
                        <div class="form-group">
                            <label class="mb-2 question-title"></label>
                        </div>
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
                        <div class="option-show">

                        </div>
                        <button id="submit-add-option" style="width: 100%; background-color: #2e80ff; display: none;"
                            type="submit" class="btn btn-secondary">Add
                            Option</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-toggle="modal" data-dismiss="modal">Close</button>
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
                        $('#addOptions').modal('show');
                        $('#new-member').modal('toggle');
                        $('.question-title').html(
                            '<div><span style="font-weight: 900;">Question : </span>' + result
                            .question +
                            '</div>');
                        $("#idQuestionn").val(result.id);
                        toastr.info('Add success.Please add options below!');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href="">Why do I have this issue?</a>'
                        })
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
                    console.log(result);
                    $('#option').val('');
                    if (result.iscorrect == 1) {
                        $("#isCorrect").prop('checked', false);
                        $("#isCorrect").attr('disabled', true);
                    }
                    $('.option-show').append('<textarea style="resize: none;" rows="2" class="bg-' + ((
                            result.iscorrect == 1) ? 'success' : 'danger') +
                        ' form-control" rows="3" disabled>' +
                        result.value + '</textarea>');
                },
            });
        })
        $("#new-member").on("hidden.bs.modal", function() {
            $("#quiz_id option[value=0]").prop("selected", true);
            $('#value_question').val('');
        });
        $("#addOptions").on("hidden.bs.modal", function() {
            $(".option-show").html('');
            $(".question-title").html('');
            $("#idQuestionn").val('');
            $("#option").val('');
            $("#sms_unique_option").html('');
            $("#isCorrect").prop("checked", false);
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
