@extends('admin.inc.main')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Quiz list</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <div class="action-btn">

                                <div class="form-group mb-0">
                                    <div class="input-container icon-left position-relative">
                                        <span class="input-icon icon-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-calendar">
                                                <rect x="3" y="4" width="18" height="18"
                                                    rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control form-control-default date-ranger"
                                            name="date-ranger" placeholder="Oct 30, 2019 - Nov 30, 2019">
                                        <span class="input-icon icon-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown action-btn">
                                <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button"
                                    id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <span class="dropdown-item">Export With</span>
                                    <div class="dropdown-divider"></div>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-print"></i> Printer</a>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-file-pdf"></i> PDF</a>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-file-text"></i> Google Sheets</a>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-file-excel"></i> Excel (XLSX)</a>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-file-csv"></i> CSV</a>
                                </div>
                            </div>
                            <div class="dropdown action-btn">
                                <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button"
                                    id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-share"></i> Share
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                    <span class="dropdown-item">Share Link</span>
                                    <div class="dropdown-divider"></div>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-facebook"></i> Facebook</a>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-twitter"></i> Twitter</a>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-google"></i> Google</a>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-feed"></i> Feed</a>
                                    <a href="" class="dropdown-item">
                                        <i class="la la-instagram"></i> Instagram</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-header">
                            <h6>Add Quiz</h6>
                        </div>
                        <div class="card-body py-md-30">
                            <form action="/admin/add-quizcategory" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-25">
                                        <input type="text" class="form-control" name="quizCategoryName"
                                            id="quizCategoryName" aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="col-md-4 mb-25">
                                        <select class="js-example-basic-single js-states form-control" name="time"
                                            id="time" aria-label="Default select example" required>
                                            <option value="">Choose time</option>
                                            @foreach (config('constants.time_quiz') as $key => $value)
                                                <option value="{{ $key }}">{{ $value }} minutes</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-25">
                                        <select class="js-example-basic-single js-states form-control" name="category"
                                            id="category" aria-label="Default select example" required>
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
                                    {{-- <div class="col-md-12 mb-25">
                                        <textarea class="form-control" placeholder="Description" id="description" name="description"></textarea>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="layout-button mt-0">
                                            <button type="submit"
                                                class="btn
                                                btn-primary btn-default btn-squared px-30">save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- ends: .card -->

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
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect ',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat ',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ]
        });
    </script>
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
