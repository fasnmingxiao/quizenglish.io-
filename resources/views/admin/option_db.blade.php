@extends('admin.inc.main')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Option list</h4>
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
                            <table id="option-table" class=" table mb-0 table-borderless">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="userDatatable-title">#</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Question</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Option</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Is Correct</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Action</span>
                                        </th>
                                    </tr>
                                </thead>

                            </table>
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
                    <h6 class="modal-title fw-500" id="staticBackdropLabel">Create topic</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span data-feather="x"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="new-member-modal">
                        <form id="updateOption" method="POST">
                            @csrf
                            <div class="form-group mb-20">
                                <div class="position-relative">
                                    <input type="hidden" id="idOption" name="idOption">
                                    <input type="hidden" id="question_id" name="question_id">
                                    <input type="text" name="option" id="option" class="form-control"
                                        placeholder="option" required>
                                    <div style="top:10%;right:15px" class="icon-check position-absolute"></div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <div class="checkbox-theme-default custom-checkbox ">
                                    <input class="checkbox" type="checkbox" name="iscorrect" id="iscorrect">
                                    <label for="iscorrect">
                                        <span class="checkbox-text">
                                            Check if option is correct.
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="button-group d-flex pt-25">
                                <button class="btn btn-primary btn-default btn-squared text-capitalize">save
                                </button>
                                <button type="submit"
                                    class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light">cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            var datatable = $('#option-table').DataTable({
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
                    url: "{{ route('ajax.option') }}",
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
                        data: "question_name",
                        orderable: true,
                        className: 'text-center media-middle ',
                        render: function(data, type, row) {
                            return ' <div class="userDatatable-content">' + row.question_name +
                                '</div>';
                        }
                    },
                    {
                        data: "value",
                        orderable: true,
                        className: 'media-middle text-center media-middle',
                        render: function(data, type, row) {
                            return ' <div class="userDatatable-content">' + row.value +
                                '</div>';
                        }
                    },
                    {
                        data: "iscorrect",
                        orderable: true,
                        className: 'media-middle text-center media-middle',
                        render: function(data, type, row) {
                            return '<div class="userDatatable-content">' + (row.iscorrect ? 'true' :
                                'false') + '</div>';
                        }
                    },
                    {
                        data: "action",
                        orderable: true,
                        className: 'media-middle text-center media-middle',
                    },

                ],
            });
            $(document).on('click', '.edit-button', function() {
                $('#new-topic').modal('show');
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '/admin/ajax/option/' + id,
                    success: function(data) {
                        $('#idOption').val(data.id)
                        $('#question_id').val(data.question_id)
                        $('#option').val(data.value)
                        if (data.iscorrect) {
                            $('#iscorrect').prop('checked', true);
                        } else {
                            $('#iscorrect').prop('checked', false);
                        }
                    }
                })
            })
            $('#updateOption').on('submit', function(e) {
                e.preventDefault();
                var idOption = $('#idOption').val();
                var question_id = $('#question_id').val();
                var option = $('#option').val();
                var isCorrect = $('#iscorrect').is(":checked");
                var token = $('input[name="_token"]').val();
                if (iscorrect) {
                    iscorrect = 1;
                } else {
                    iscorrect = 0;
                }
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: token,
                        option: option,
                        idQuestion: question_id,
                        idOption: idOption,
                        isCorrect: iscorrect
                    },

                    url: '{{ route('ajax.option.update') }}',
                    success: function(rs) {
                        if (rs) {
                            $('#new-topic').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Update option!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    }
                })
            })
        });
    </script>
    @include('admin.inc.alert')
@endsection
