@extends('admin.inc.main')

@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main user-member justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Topic & category list</h4>
                                <span class="sub-title ml-sm-25 pl-sm-25">{{ count($data) }} Topic & Categories</span>
                            </div>

                            {{-- <form action="/" class="d-flex align-items-center user-member__form my-sm-0 my-2">
                                <span data-feather="search"></span>
                                <input class="form-control mr-sm-2 border-0 box-shadow-none" type="search"
                                    placeholder="Search by Name" aria-label="Search">
                            </form> --}}

                        </div>
                        <div class="action-btn">
                            <div class="d-flex">
                                <a href="#" class="btn px-15 btn-primary mr-3" data-toggle="modal"
                                    data-target="#new-topic">
                                    <i class="las la-plus fs-16"></i>Add New Topic</a>
                                <a href="#" class="btn px-15 btn-primary" data-toggle="modal"
                                    data-target="#new-category">
                                    <i class="las la-plus fs-16"></i>Add New Category</a>
                            </div>

                            <!-- Modal -->
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
                                                <form action="/admin/add-topic" method="POST">
                                                    @csrf
                                                    <div class="form-group mb-20">
                                                        <div class="position-relative">
                                                            <input type="text" name="name" id="newNameCategory"
                                                                class="form-control" placeholder="name" required>
                                                            <div style="top:10%;right:15px"
                                                                class="icon-check position-absolute"></div>
                                                        </div>
                                                    </div>
                                                    <div class="button-group d-flex pt-25">
                                                        <button
                                                            class="btn btn-primary btn-default btn-squared text-capitalize">save
                                                        </button>
                                                        <button data-dismiss="modal"
                                                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light">cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade new-member" id="new-category" role="dialog" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content  radius-xl">
                                        <div class="modal-header">
                                            <h6 class="modal-title fw-500" id="staticBackdropLabel">Create category</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span data-feather="x"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="new-member-modal">
                                                <form action="/admin/add-category" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group mb-20">
                                                        <input type="text" class="form-control" name="categoryName"
                                                            id="categoryName" placeholder="name"
                                                            value="{{ old('categoryName') }}" required>
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <div class="category-member">
                                                            <select class="js-example-basic-single js-states form-control"
                                                                id="topic" name="topic" required>
                                                                <option value="">Choose Topic</option>
                                                                @if (count($listTopic) > 0)
                                                                    @foreach ($listTopic as $value)
                                                                        @if ($value['parent_id'] == 0)
                                                                            <option value="{{ $value['id'] }}">
                                                                                {{ $value['name'] }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-20">
                                                        <textarea class="form-control" placeholder="Description category" id="description" name="description"
                                                            style="height: 150px;" required>{{ old('description') }}</textarea>
                                                    </div>
                                                    <div class="custom-file  mb-20">
                                                        <input class="form-control " type="file" id="file"
                                                            name="file" onchange="loadFile(event)" accept="image/*"
                                                            required>

                                                        <script>
                                                            var loadFile = function(event) {
                                                                img_base = document.getElementById('img_base');
                                                                // img_base.style.display = 'none';
                                                                var output = document.getElementById('img_output');
                                                                output.src = URL.createObjectURL(event.target.files[0]);
                                                                output.onload = function() {
                                                                    URL.revokeObjectURL(output.src) // free memory
                                                                    console.log(output.style)
                                                                    output.style.width = 'auto';
                                                                    output.style.maxWidth = '404px';
                                                                    output.style.maxHeight = '404px';
                                                                    output.style.height = 'auto';
                                                                    img_base.style.padding = '0px';
                                                                    img_base.style.border = 'none';
                                                                    output.style.borderRadius = '10px';
                                                                }
                                                            };
                                                        </script>
                                                    </div>
                                                    <img id="img_output" style="margin: 0 auto;padding-top: 21px;"
                                                        src="" alt="" srcset="">
                                                    <div class="button-group d-flex pt-25">
                                                        <button
                                                            class="btn btn-primary btn-default btn-squared text-capitalize">save
                                                        </button>
                                                        <button data-dismiss="modal"
                                                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light">cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade new-member" id="modal-container" role="dialog" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content  radius-xl">
                                        <div class="modal-header">
                                            <h6 class="modal-title fw-500" id="staticBackdropLabel">Update topic &
                                                Category</h6>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span data-feather="x"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="new-member-modal">
                                                <form action="/admin/UpdateCategory" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="idcat" id="idcat">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="newNameCategory"
                                                            id="editNameCategory" placeholder="name topic - category">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="category-member">
                                                            <select class="js-example-basic-single js-states form-control"
                                                                id="TopicName" name="topic" required>
                                                                <option value="">Choose Topic</option>
                                                                @if (count($listTopic) > 0)
                                                                    @foreach ($listTopic as $value)
                                                                        @if ($value['parent_id'] == 0)
                                                                            <option value="{{ $value['id'] }}">
                                                                                {{ $value['name'] }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <textarea class="form-control" placeholder="Description category" id="editDesCategory" name="newDesCategory"
                                                            style="height: 150px;"></textarea>
                                                    </div>
                                                    <input type="hidden" name="old_thumb" class="old_thumb">
                                                    <div class="custom-file" id="UploadNewThumb">
                                                        <input class="form-control" type="file" id="editThumbCategory"
                                                            name="file" onchange="filePreview(this)">

                                                        <script>
                                                            var loadFile = function(event) {
                                                                img_base = document.getElementById('img_base');
                                                                // img_base.style.display = 'none';
                                                                var output = document.getElementById('img_output');
                                                                output.src = URL.createObjectURL(event.target.files[0]);
                                                                output.onload = function() {
                                                                    URL.revokeObjectURL(output.src) // free memory
                                                                    console.log(output.style)
                                                                    output.style.width = 'auto';
                                                                    output.style.maxWidth = '404px';
                                                                    output.style.maxHeight = '404px';
                                                                    output.style.height = 'auto';
                                                                    img_base.style.padding = '0px';
                                                                    img_base.style.border = 'none';
                                                                    output.style.borderRadius = '10px';
                                                                }
                                                            };
                                                        </script>
                                                    </div>
                                                    <div class="wp-show-thumb row mb-3">
                                                        <img class="rounded" style="margin:0 auto;width:150px"
                                                            height="auto" id="showThumb">
                                                    </div>
                                                    <div class="button-group d-flex pt-25">
                                                        <button
                                                            class="btn btn-primary btn-default btn-squared text-capitalize">Update
                                                        </button>
                                                        <button data-dismiss="modal"
                                                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light">cancel
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
                <div class="col-lg-12">
                    <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="userDatatable-title">Name</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Type</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Description</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Thumb</span>
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
                                    {{ tree_topic($data) }}
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="d-flex justify-content-end pt-30">

                            <nav class="atbd-page ">
                                <ul class="atbd-pagination d-flex">
                                    <li class="atbd-pagination__item">
                                        <a href="#" class="atbd-pagination__link pagination-control"><span
                                                class="la la-angle-left"></span></a>
                                        <a href="#" class="atbd-pagination__link"><span
                                                class="page-number">1</span></a>
                                        <a href="#" class="atbd-pagination__link active"><span
                                                class="page-number">2</span></a>
                                        <a href="#" class="atbd-pagination__link"><span
                                                class="page-number">3</span></a>
                                        <a href="#" class="atbd-pagination__link pagination-control"><span
                                                class="page-number">...</span></a>
                                        <a href="#" class="atbd-pagination__link"><span
                                                class="page-number">12</span></a>
                                        <a href="#" class="atbd-pagination__link pagination-control"><span
                                                class="la la-angle-right"></span></a>
                                        <a href="#" class="atbd-pagination__option">
                                        </a>
                                    </li>
                                    <li class="atbd-pagination__item">
                                        <div class="paging-option">
                                            <select name="page-number" class="page-selection">
                                                <option value="20">20/page</option>
                                                <option value="40">40/page</option>
                                                <option value="60">60/page</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </nav>


                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('footer')
    {{-- Edit --}}
    <script>
        // $('#cat_topic').addClass('active');
        $('.edit-button').on('click', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal-container'))
            myModal.show()
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: '/admin/ajaxGetCategory/' + id,
                success: function(data) {
                    if (data['parent_id'] != 0) {
                        $('#editThumb').remove();
                        $('.wp-show-thumb').css('display', 'none');
                        // select topic
                        $("#TopicName").attr('disabled', false);
                        $("#TopicName").css("display", 'block');
                        // input file
                        $('#UploadNewThumb').css("display", "block");
                        $('#editThumbCategory').attr('disabled', false)
                        $("#editThumbCategory").css("display", "block");
                        // set src img
                        $('#wp-show-thumb').css('display', 'block');
                        $('#showThumb').attr('src', 'http://quizzeng.com/storage/images/category/' +
                            data['thumb']);
                        // set  selected
                        $(`#TopicName option[value = ${data['parent_id']}] `).attr('selected',
                            'selected');
                        //set old thumb
                        $('.old_thumb').val(data['thumb']);
                        // description
                        $('#editDesCategory').css('display', 'block');
                        //set description
                        $('#editDesCategory').val(data['description']);
                    } else {
                        $('#UploadNewThumb').css("display", "none");
                        $('#TopicName').attr('disabled', 'disabled');
                        $('#editThumbCategory').attr('disabled', 'disabled')
                        $("#TopicName").css("display", "none");
                        $("#editThumbCategory").css("display", "none");
                        $('#showThumb').attr('src', '');
                        $('#editDesCategory').css('display', 'none');
                        $('.wp-show-thumb').css('display', 'none');
                    }
                    $('#editNameCategory').val(data['name']);
                    $('#idcat').val(data['id']);
                }
            })
        })

        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#UploadNewThumb + img').remove();
                    $('#showThumb').attr('src', '');
                    $('#UploadNewThumb').after(
                        '<img id="newThumb" style="width:150px" src="' + e.target.result +
                        '" alt="" width="100%" height="auto" />'
                    )
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    {{-- End edit --}}
    {{-- Delte --}}
    <script>
        function deleteTopic(id) {
            Swal.fire({
                title: 'Do you want to delete?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: '/admin/ajaxDeleteTopic/' + id,
                        success: function(data) {
                            if (data.error != false) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Delete successfully!',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                window.setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            }
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    </script>
    <script>
        $('#cat_topic').addClass('active');
        $('#button-add').attr('disabled', true);
        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
        $('#newNameCategory').on('keyup', function() {
            var key = $(this).val();
            if (key == '') {
                $('.icon-check').html('');
                $('#button-add').attr('disabled', true);
                return false;
            }
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: '/admin/add-topic/' + key,
                success: function(data) {
                    // console.log(Object.values(data));
                    // console.log(key === '@');
                    if (Object.values(data).length == '') {
                        if (key === '@') {
                            $('#button-add').attr('disabled', true);
                            toastr.error('Topic must not have special characters');
                            $('.icon-check').hide().html(
                                '<i class="fas fa-times" style="color: #f00;font-size: 24px;line-height: 38px;margin-left: 5px;"></i>'
                            ).fadeIn(500)
                        } else {
                            $('#button-add').attr('disabled', false);
                            $('.icon-check').hide().html(
                                '<i class="fas fa-check" style="color: #33ed53;font-size: 15px;line-height: 38px;margin-left: 5px;"></i>'
                            ).fadeIn(500);
                        }
                    } else {

                        $('#button-add').attr('disabled', true);
                        toastr.error('Topic has exists');
                        $('.icon-check').hide().html(
                            '<i class="fas fa-times" style="color: #f00;font-size: 24px;line-height: 38px;margin-left: 5px;"></i>'
                        ).fadeIn(500)
                    }
                }
            })
        })
    </script>
    {{-- end delete --}}
    @include('admin.inc.alert')
@endsection
