@extends('admin.inc.main')
@section('content')
    <div class="content">
        @include('admin.inc.navbar')
        <div class="container-fluid pt-4 px-4">
            <div class="row bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-12">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h2 class="mb-4 text-center">ADD QUIZ</h2>
                            <form action="/admin/add-quizcategory" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-xl-5 mb-3 ">
                                        <label for="quizCategoryName" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="quizCategoryName"
                                            id="quizCategoryName" aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="col-sm-12 col-xl-3 mb-3 ">
                                        <label for="exampleInputEmail1" class="form-label">Times</label>
                                        <select class="form-select mb-3" name="time" id="time"
                                            aria-label="Default select example" required>
                                            <option value="">Choose time</option>
                                            @foreach (config('constants.time_quiz') as $key => $value)
                                                <option value="{{ $key }}">{{ $value }} minutes</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-xl-3 mb-4 ">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-select mb-3" name="category" id="category"
                                            aria-label="Default select example" required>
                                            <option value="">Choose Category</option>
                                            @if (count($listTopic) > 0)
                                                @foreach ($listTopic as $value)
                                                    @if ($value['parent_id'] != 0)
                                                        <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"
                                        style="height: 150px;" required></textarea>
                                    <label for="description">Description</label>
                                </div>
                                <button type="submit" class="btn btn-primary d-block" style="margin: 0 auto;">CREATE
                                    SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- table --}}
        <div class="container-fluid pt-4 px-4">
            <div class="row bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-12">
                    <div class="bg-secondary rounded h-100 p-4 position-relative">
                        <h2 class="mb-4 text-center">LIST QUIZZ</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Name Exam</th>
                                        <th scope="col">Desciption</th>
                                        <th scope="col">Total Question</th>
                                        <th scope="col">Times</th>
                                        <th scope="col">Created_at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($quizs) > 0)
                                        @foreach ($quizs as $item)
                                            <tr>
                                                <th scope="row">{{ $item->id }}</th>
                                                <td>{{ $item->catTopic->name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ count($item->question) }} questions</td>
                                                <td>{{ config('constants.time_quiz.' . $item->time) }} minutes</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <button id="two" type="button" data-id="{{ $item->id }}"
                                                        class="edit-button btn btn-outline-info m-2">Edit</button>
                                                    <button data-id="{{ $item->id }}" type="button"
                                                        class=" buttonDelete btn btn-outline-danger m-2">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <th colspan="7">No data found</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $quizs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <div id="modal-container" class="update">
        <div class="modal-background">
            <div class="modal" style=" border-radius: 50px;">
                <div class="report-content">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">UPDATE QUIZZ</h6>
                        <form action="/admin/update-quizcategory" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" id="setId" name="id" class="bg-transparent">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="quizCategoryName" id="setCategoryName"
                                    placeholder="Quiz Category title" required>
                                <label for="setCategoryName">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Description category" id="description" name="description"
                                    style="height: 150px;"></textarea>
                                <label for="description">Description</label>
                            </div>
                            <select id="TopicName" name="topic" class="form-select mb-3">
                                <option selected="">Choose Topic</option>
                                @if (count($listTopic) > 0)
                                    @foreach ($listTopic as $value)
                                        @if ($value['parent_id'] != 0)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <select id="setTime" name="time" class="form-select mb-3" required>
                                <option value="">Choose Time</option>
                                @if (count($listTopic) > 0)
                                    @foreach (config('constants.time_quiz') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }} minutes</option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="submit" class="btn btn-primary">UPDATE SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $('#quiz').addClass('active');
        $('.edit-button').on('click', function() {
            var buttonID = $(this).attr('id');
            $("#modal-container.update").removeAttr("class").addClass(buttonID);
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: '/admin/QuizTest/' + id,
                success: function(data) {
                    $('#setId').val(data.id);
                    $('#setCategoryName').val(data.name);
                    $('#description').val(data.description);
                    $("#setTime").val(data.time);
                    $('#TopicName').val(data.cat_id);
                }
            })
        })
        $('.buttonDelete').on('click', function() {
            if (confirm('Are u sure?')) {
                var id = $(this).data('id');
                return window.location = `/admin/quizcategory/${id}/delete`;
            }
            return false;
        })
    </script>
    @include('admin.inc.alert')
@endsection
