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
                            <table class="table mb-0 table-borderless" id="quiz_table">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="userDatatable-title"> # </span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Category</span>
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
                                            <span class="userDatatable-title">Action</span>
                                        </th>
                                    </tr>
                                </thead>
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

    <div class="modal fade new-member" id="new-topic" role="dialog" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content  radius-xl">
                <div class="modal-header">
                    <h6 class="modal-title fw-500" id="staticBackdropLabel">UPDATE QUIZZ</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span data-feather="x"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="new-member-modal">
                        <form action="/admin/update-quizcategory" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" id="setId" name="id" class="bg-transparent">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="quizCategoryName" id="setCategoryName"
                                    placeholder="Quiz Category title" required>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Description category" id="description" name="description"
                                    style="height: 150px;"></textarea>
                            </div>
                            <select class="js-example-basic-single js-states form-control mb-3" id="TopicName"
                                name="topic" required>
                                <option selected="">Choose Topic</option>
                                @if (count($listTopic) > 0)
                                    @foreach ($listTopic as $value)
                                        @if ($value['parent_id'] != 0)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <div class="form-floating mb-3">
                                <select id="setTime" name="time"
                                    class="js-example-basic-single js-states form-control " required>
                                    <option value="">Choose Time</option>
                                    @if (count($listTopic) > 0)
                                        @foreach (config('constants.time_quiz') as $key => $value)
                                            <option value="{{ $key }}">{{ $value }} minutes</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
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
        $(document).ready(function () {
            var datatable = $('#quiz_table').DataTable({
                bAutoWidth: false,
                stateSave: true,
                processing: true,
                serverSide: true,
                searching: false,
                "ordering": false,
                order: [],
                ajax: {
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    url: "{{ route('ajax.quiz') }}",
                    type: "POST",
                    dataSrc: function(response) {
                        response.recordsTotal = response.recordsTotal;
                        response.recordsFiltered = response.recordsTotal;
                        response.draw = response.draw;
                        return response.result;
                    },
                },
                columns: [{
                        data: 'id',
                        orderable: false,
                        className: ' userDatatable-content text-center media-middle',
                        render: function(data, type, row, meta) {
                            return datatable.page.info().start + (meta.row + 1);
                        }
                    },
                    {
                        data: "cat_name",
                        orderable: true,
                        className: 'text-center media-middle ',
                        render: function(data, type, row) {
                            return ' <div class="userDatatable-content">' + row.cat_name +
                                '</div>';
                        }
                    },
                    {
                        data: "name",
                        orderable: true,
                        className: 'media-middle text-center media-middle',
                        render: function(data, type, row) {
                            return ' <div class="userDatatable-content">' + row.name +
                                '</div>';
                        }
                    },
                    {
                        data: "description",
                        orderable: false,
                        className: 'media-middle text-center media-middle',
                        render: function(data, type, row) {
                            return '<div class="userDatatable-content">' + row.description + '</div>';
                        }
                    },
                    {
                        data: "qty_question",
                        orderable: true,
                        className: 'media-middle text-center media-middle',
                        render: function(data, type, row) {
                            return '<div class="userDatatable-content">' + row.qty_question + '</div>';
                        }
                    },
                    {
                        data: "times",
                        orderable: true,
                        className: 'media-middle text-center media-middle',
                        render: function(data, type, row) {
                            return '<div class="userDatatable-content">' + row.times + '</div>';
                        }
                    },
                    {
                        data: "action",
                        orderable: true,
                        className: 'media-middle text-center media-middle',
                    },

                ],
            });
        });
    </script>
    <script>
        $('#quiz').addClass('active');
        $(document).on('click','.edit-button', function() {
            var buttonID = $(this).attr('id');
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: '/admin/QuizTest/' + id,
                success: function(data) {
                    $('#new-topic').modal('show');
                    $('#setId').val(data.id);
                    $('#setCategoryName').val(data.name);
                    tinyMCE.get('description').setContent(data.description);
                    $('#description').val();
                    $("#setTime").val(data.time);
                    $('#TopicName').val(data.cat_id);
                }
            })
        })
        $(document).on('click','.buttonDelete', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    var id = $(this).data('id');
                return window.location = `/admin/quizcategory/${id}/delete`;
                }
            return false;

            })
        })
    </script>
    @include('admin.inc.alert')
@endsection
