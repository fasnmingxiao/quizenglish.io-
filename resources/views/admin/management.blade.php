@extends('admin.inc.main')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Roles Management</h4>
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
                            <table id="user-table" class=" table mb-0 table-borderless">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th class="col-md-1">
                                            <span class="userDatatable-title">#</span>
                                        </th>
                                        <th class="col-md-2 text-center">
                                            <span class="userDatatable-title">Role</span>
                                        </th>
                                        <th class="col-md-7 text-center">
                                            <span class="userDatatable-title">Perrmission</span>
                                        </th>
                                        <th class="col-md-2 text-center">
                                            <span class="userDatatable-title">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @if (count($roles) > 0)
                                        @foreach ($roles as $role)
                                            @php
                                                $count++;
                                            @endphp

                                            <tr>
                                                <td>
                                                    <div class="userDatatable-content">
                                                        {{ $count }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content text-center">
                                                        {{ $role->name }}
                                                    </div>
                                                </td>
                                                <td class="d-flex justify-content-center flex-wrap">
                                                    @foreach ($role->permissions as $permission)
                                                        <div class="userDatatable-content d-inline-block mb-1"
                                                            id="permission-{{ $permission->id }}">
                                                            <span
                                                                class="bg-opacity-warning color-warning rounded-pill userDatatable-content-status active avatar"
                                                                style="background-color: #ffe020; color: black; margin: 0 6px;">
                                                                <i class="fas fa-shield-alt"></i>&nbsp;
                                                                {{ $permission->name }}
                                                                <span data-per="{{ $permission->id }}"
                                                                    data-role="{{ $role->id }}"
                                                                    class="btn-remove-permission avatar-badge-wrap"
                                                                    style="top:-5px; right:-9px;cursor: pointer;">
                                                                    <span
                                                                        class=" badge badge-danger badge-round badge-md">X</span>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                    <div class="userDatatable-content d-inline-block mb-1"
                                                        id="permission-new" style="cursor: pointer;">
                                                        <span
                                                            class=" color-warning rounded-pill userDatatable-content-status active avatar"
                                                            style="background-color: #dbdbe6; color: black; margin: 0 6px;">
                                                            <i class="fas fa-shield-alt"></i>&nbsp;
                                                            Assign more permissions ...
                                                            <span data-role="{{ $role->id }}"
                                                                class="btn-add-permission avatar-badge-wrap"
                                                                style="top:2px; right:-12px">
                                                                <span class="badge badge-round badge-md"
                                                                    style="background-color: #29ca71; color:white;"><i
                                                                        class="fas fa-plus"></i></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                        <li>
                                                            <a href="#" class="edit">
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
                                                            <a href="#" class="remove">
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
                                    @endif
                                </tbody>
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
            $('.btn-remove-permission').on('click', function() {
                var role = $(this).data('role');
                var permission = $(this).data('per');
                console.log('role -permission', role, permission);
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
                        $.ajax({
                            type: "POST",
                            datatype: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                role: role,
                                permission: permission
                            },
                            url: '{{ route('management.unsetpermission') }}',
                            success: function(result) {
                                if (result.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    window.setTimeout(function() {
                                        $(`#permission-${permission}`).hide(
                                            'slow',
                                            function() {
                                                $(`#permission-${permission}`)
                                                    .remove();
                                            });
                                    }, 1500);
                                } else {
                                    Swal.fire(
                                        'Delete failer!',
                                        'Sorry, please try again!.',
                                        'error'
                                    )
                                }
                            },
                        });

                    }
                })
            })
        })
    </script>
    @include('admin.inc.alert')
@endsection
