@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            <div class="add_question mt-0">
                @include('breadcumb')
                <br>
                @include('alert')
                <div class="d-flex justify-content-between">
                    <div class="text_head mb-5">{{ $listItem->name }}</div>
                    <button data-toggle="modal" data-target="#addCategory" type="button" class="submit_quizz add false"
                        style="font-size:25px; padding:20px 50px;border:none;margin-bottom:25px;">Add
                    </button>
                </div>

                <table class="table">
                    <thead class="thead_color-blue">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Total questions</th>
                            <th scope="col">Time</th>
                            <th scope="col">Action</th>
                            <th scope="col">Add questions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 0;
                        @endphp
                        @foreach ($listItem->quizCategory as $value)
                            @php
                                $num++;
                            @endphp
                            <tr>
                                <th scope="row">{{ $num }}</th>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ count($value->question) }}</td>
                                <td>{{ config('constants.time_quiz.' . $value->time) }} minutes</td>
                                <td>
                                    <a data-name="{{ $value->name }}" data-id={{ $value->id }}
                                        href="#modalDetailTestQuiz" class="buttonDetailTestQuiz mr-3">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a data-id={{ $value->id }} href="#editCategory" class="button-edit mr-3"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#" data-id={{ $value->id }} class="buttonDelete"><i
                                            class="fa-solid fa-trash-can delete_color-red"></i></a>
                                </td>
                                <td>
                                    <a href="/admin/add-question/{{ $value->id }}" class=""
                                        style="color:var(--white);background-color:var(--blue); padding: 5px 60px;border-radius:15px;">Add</a>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal add -->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 20px;     background: var(--background);">
                <div class="modal-header" style="font-size: 25px;font-weight:700; background-color:#F6FAFF;">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Quiz Category {{ $listItem->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 35px;">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" style="background: rgb(251, 251, 251/80%);">
                    <form action="/admin/add-quizcategory" method="POST" enctype="multipart/form-data"
                        class="add_quizz mb-0 mt-0">
                        @csrf
                        <div class="list mb-3">
                            <div class="topic">
                                <div class="content-wrap mr-0">
                                    <input type="hidden" id="category" name="category" value="{{ $listItem->id }}"
                                        class="bg-transparent">
                                    <input type="text" name="quizCategoryName" placeholder="Quiz Category title"
                                        class="bg-transparent" required>
                                    <!-- <div class="custom-select"> -->
                                    <select id="time" name="time" required>
                                        <option value="">Choose Time</option>
                                        @foreach (config('constants.time_quiz') as $key => $value)
                                            <option value="{{ $key }}">{{ $value }} minutes</option>
                                        @endforeach
                                    </select>
                                    <!-- </div> -->
                                    <textarea class="bg-transparent" name="description" cols="30" rows="9" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class=""
                            style="border: none;background-color: var(--blue);padding: 15px 20px;font-weight: 700;color: var(--white);border-radius: 20px;"><span>Submit
                                Create</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal edit -->
    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 20px;     background: var(--background); ">
                <div class="modal-header" style="font-size: 25px;font-weight:700; background-color:#F6FAFF;  ">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Quiz Category {{ $listItem->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 35px;">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" style="background: rgb(251, 251, 251/80%);">
                    <form action="/admin/update-quizcategory" method="POST" enctype="multipart/form-data"
                        class="add_quizz mb-0 mt-0">
                        @csrf
                        @method('put')
                        <div class="list mb-3">
                            <div class="topic">
                                <div class="content-wrap mr-0">
                                    <input type="hidden" id="setId" name="id" class="bg-transparent">
                                    <input type="text" name="quizCategoryName" id="setCategoryName"
                                        placeholder="Quiz Category title" class="bg-transparent" required>
                                    <!-- <div class="custom-select"> -->
                                    <select id="setTime" name="time" required>
                                        <option value="">Choose Time</option>
                                        @foreach (config('constants.time_quiz') as $key => $value)
                                            <option value="{{ $key }}">{{ $value }} minutes</option>
                                        @endforeach
                                    </select>
                                    <!-- </div> -->
                                    <textarea class="bg-transparent" name="description" id="setDescription" cols="30" rows="9"
                                        placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class=""
                            style="border: none;background-color: var(--blue);padding: 15px 20px;font-weight: 700;color: var(--white);border-radius: 20px;"><span>Submit
                                Create</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Show Detail Test Quiz -->
    <div class="modal fade" id="modalDetailTestQuiz" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:20px;     background: var(--background);">
                <div class="modal-header" style="background-color:var(--blue); color:var(--white);">
                    <h5 class="modal-title titleModalDetailTestQuiz" id="exampleModalCenterTitle"
                        style="font-size: 25px;">
                        Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 35px;">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="bodyModalShow">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('.button-edit').on('click', function() {
                $('#editCategory').modal();
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    datatype: "JSON",
                    url: '/admin/QuizTest/' + id,
                    success: function(result) {
                        $('#setCategoryName').val(result['name']);
                        $('#setDescription').val(result['description']);
                        $('#setId').val(result['id']);
                        $('#setTime').val(result['time']);
                    },
                });
            })


            // SHOW MODAL LIST QUESTION
            $('.buttonDetailTestQuiz').on('click', function() {
                $('#modalDetailTestQuiz').modal();
                var name = $(this).data("name");
                $('.titleModalDetailTestQuiz').html(name);
                var id = $(this).data('id');
                var html = '';
                $.ajax({
                    type: "GET",
                    datatype: "JSON",
                    url: '/admin/QuestionByQuiz/' + id,
                    success: function(result) {
                        var bullets = 'abcdefghijklmnopqrstuvwxyz'.toUpperCase().split('');
                        var count = 0;
                        var num_question = 0;
                        if (result != '') {
                            $.each(result, function(k, v) {
                                num_question++;
                                html += '<div class="question-item">';
                                html +=
                                    `<div class="question-title">Question ${num_question} : ${v.question}</div>`;
                                html += '<ul class="list-option-question">';
                                $.each(v.options, function(k, option) {
                                    html += '<li>';
                                    html +=
                                        `<p class="pb-2"><span>${bullets[count]}. </span> ${option.value} `;
                                    if (option.iscorrect == 0) {
                                        html += '&nbsp' +
                                            '<i class="fa-solid fa-xmark  text-danger"></i>';
                                    } else {
                                        html += '&nbsp' +
                                            '<i class="fa-solid fa-circle-check text-success"></i>';
                                    }
                                    html += '</p>';
                                    html += `</li>`;
                                })
                                html += '</ul>';
                                html += '<hr>';
                                html += '</div>';
                            })
                        } else {
                            html += 'No data found';
                        }
                        $('#bodyModalShow').html(html);
                    },
                });
            })

            $('.buttonDelete').on('click', function() {
                if (confirm('Are u sure?')) {
                    var id = $(this).data('id');
                    return window.location = `/admin/quizcategory/${id}/delete`;
                }
                return false;
            })

        })
    </script>
@endsection
