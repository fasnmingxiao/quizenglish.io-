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
                    <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="checkbox-text userDatatable-title">Category</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Name</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Desciption</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Total Question</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Times</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Created_at</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title float-right">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @if (count($quizs) > 0)
                                        @foreach ($quizs as $item)
                                            <tr>
                                                <td>
                                                    <div class="userDatatable-content">{{ $item->catTopic->name }} </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content">{{ $item->name }}</div>
                                                </td>
                                                <td>
                                                    <div style="padding-top:17px;" class="userDatatable-content">{!! $item->description !!}</div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content">{{ count($item->question) }}
                                                        questions</div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content">
                                                        {{ config('constants.time_quiz.' . $item->time) }} minutes</div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content">{{ $item->created_at }}</div>
                                                </td>
                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                        <li>
                                                            <a href="#" class="edit edit-button"
                                                                data-id="{{ $item->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
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
                                                                class="buttonDelete remove">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-trash-2">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11" x2="10"
                                                                        y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14"
                                                                        y2="17"></line>
                                                                </svg></a>
                                                        </li>
                                                    </ul>
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
                        </div>
                        <div class="d-flex justify-content-end pt-30">
                            <nav class="atbd-page ">
                                {{ $quizs->links() }}
                            </nav>
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
