@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            @include('breadcumb')
            @include('alert')

            <div class="quizzes">
                <div class="quizzes_search">
                    <div class="bg-fluid" style="">
                    </div>

                    <?php
            if(!empty(Auth::user()->role) && Auth::user()->role == 1)
            {
        ?>
                    <div class="head">Choose in topic to add the quiz</div>
                    <?php
            }
        ?>
                    <?php
                        if(!empty(Auth::user()->role) && Auth::user()->role == 2)
                            {
                    ?>
                    <div class="head">Please choose topic to start learn</div>
                    <?php
                      }
                    ?>
                    <div class="search--wrapper">
                        <input type="search" name="" id="" class="input_search" placeholder="Search">
                        <button type="button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>

                    <button type="button" class="add mr-3"
                        style="border:none; float: right; color: var(--white);background: #FF8D8D; font-size: 25px; padding: 20px 50px;"
                        data-toggle="modal" data-target="#modalAddTopic">
                        Add topic
                    </button>

                    <a href="{{ route('admin.addCategory') }}" class="add mr-3"
                        style="text-decoration: none; float: right; color: var(--white);background: #5E9DFF; font-size: 25px; padding: 20px 50px;">
                        Add category
                    </a>
                    <a href="/admin/add-quizcategory" class="add mr-3 "
                        style="text-decoration: none; float: right; color: var(--white);background: #51EDB8; font-size: 25px; padding: 20px 50px;">
                        Add Quizz
                    </a>
                </div>

                @if (count($listTopic) > 0)
                    @foreach ($listTopic as $item)
                        @if ($item['parent_id'] == 0)
                            <div class="quizzes_section">
                                <div class="quizzes_section_head">
                                    {{ $item['name'] }}
                                    <a href="#modalEditTopic" class="editTopicButton" data-id={{ $item['id'] }}
                                        data-whatever="{{ $item['name'] }}"><i class="fa-solid fa-pen"
                                            style="font-size:35px"></i>
                                    </a>
                                    <!-- <a href="#" style="text-decoration: none; color:var(--red); font-size:21px;" onclick="deleteTopic({{ $item['id'] }})" data-id={{ $item['id'] }}>Delete Topic</a> -->

                                </div>
                                <div class="row">
                                    @foreach ($listTopic as $subItem)
                                        @if ($subItem['parent_id'] == $item['id'])
                                            <div class="c-4">
                                                <div class="quizzes_section_item ">
                                                    <a onclick="return confirm('Are you sure?')"
                                                        href="category/{{ $subItem->id }}/delete"><i
                                                            class="fa-solid fa-trash delete"></i></a>
                                                    <a href="listQuizTest/{{ $subItem->id }}">
                                                        <img src="/storage/images/category/{{ $subItem['thumb'] }}"
                                                            alt="" class="img">

                                                    </a>
                                                    <div class="sub_content">
                                                        <div class="text_head">{{ $subItem['name'] }}</div>
                                                        <div class="text_sub">
                                                            {{ $subItem['description'] }}
                                                        </div>
                                                        <div class="wrap">
                                                            <div class="lession">
                                                                {{ count($subItem->quizCategory) }} lession
                                                            </div>
                                                            <div class="edit editButtonCategory"
                                                                data-id="{{ $subItem->id }}">
                                                                Edit
                                                                <i class="fa-solid fa-pen"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 20px;     background: var(--background);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal add topic -->
        <div class="modal fade" id="modalAddTopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 20px;     background: var(--background);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/add-topic" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Enter topic name
                                    </span>
                                </div>
                                <input type="text" class="form-control nameTopic" name="nameTopic" required>
                                <div class="wp-icon-check">

                                </div>
                            </div>
                            <div class="d-flex  justify-content-end" id="button-add-topic">
                                <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                                <div class="wp-submit-add-topic"></div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal edit topic -->
        <div class="modal fade" id="modalEditTopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 20px;     background: var(--background);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/update-topic" method="POST">
                            @csrf
                            @method('put')
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Enter topic name
                                    </span>
                                </div>

                                <input type="text" class="form-control nameTopic" name="nameTopic" required>
                                <input type="hidden" class="form-control" name="idTopic" required>
                                <div class="wp-icon-check">

                                </div>
                            </div>
                            <div class="wp-delete-topic">

                            </div>
                            <div class="d-flex  justify-content-end" id="button-add-topic">
                                <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                                <div class="wp-submit-add-topic"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal edit Category -->
        <div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 20px;     background: var(--background);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formUpdateCategory" action="/admin/UpdateCategory" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="idcat" id="idcat">
                            <div class="form-group">
                                <select class="form-control" id="TopicName" name="topic" required>
                                    <option value="">Choose Topic</option>
                                    @if (count($listTopic) > 0)
                                        @foreach ($listTopic as $item)
                                            @if ($item['parent_id'] == 0)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name Category</label>
                                <input type="text" class="form-control" name="newNameCategory" id="nameCategory"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" id="newDesCategory" name="newDesCategory" rows="3" required></textarea>
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="old_thumb" class="old_thumb">
                            </div>
                            <div class="input-group mb-3" id="UploadNewThumb">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="newThumbCategory" name="file"
                                        onchange="filePreview(this)">
                                    <label class="custom-file-label" for="newThumbCategory">Choose file</label>
                                </div>
                            </div>
                            <img class="rounded" width="100%" height="auto" id="showThumb">
                            <div class="d-flex  justify-content-end">
                                <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('footer')
        {{-- preview thumb --}}
        <script>
            function filePreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#UploadNewThumb + img').remove();
                        $('#UploadNewThumb').after('<img src="' + e.target.result +
                            '" alt="" width="100%" height="auto" />')
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        <script>
            $('.editTopicButton').on('click', function() {
                $('#modalEditTopic').modal();
                var id = $(this).data('id');
                var name = $(this).data('whatever');
                $('input[name="nameTopic"]').val(name);
                $('input[name="idTopic"]').val(id);
                $('#modalEditTopic .modal-title').html('Edit Topic ' + name);
                var buttonDeleteTopic = '<a href="#" style="text-decoration: none; color:var(--red); font-size:21px;"';
                buttonDeleteTopic += `onclick = "deleteTopic(${id})"`;
                buttonDeleteTopic += `data-id = ${id} > Delete Topic </a>`;
                $('.wp-delete-topic').html(buttonDeleteTopic);
            })
            $('.editButtonCategory').on('click', function() {
                $('#modalEditCategory').modal();
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '/admin/ajaxGetCategory/' + id,
                    success: function(data) {
                        console.log(data);
                        $('#newDesCategory').val(data['description']);
                        $('#showThumb').attr('src', '/storage/images/category/' + data['thumb']);
                        $('#nameCategory').val(data['name']);
                        $('.old_thumb').val(data['thumb']);
                        $(`#TopicName option[value = ${data['parent_id']}] `).attr('selected', 'selected');
                        $('#idcat').val(data['id']);
                    }
                })
            })
            // $('#newThumbCategory').on('change', function() {
            //     var newThumb = $('#newThumbCategory').val();
            //     if (newThumb != '') {
            //         return alert(2);
            //     }
            //     return alert(1);
            // })
        </script>
        {{-- deleete Topic --}}
        <script>
            $('#submit-add-topic').attr('disabled', 'disabled');

            function deleteTopic(id) {
                var result = confirm("Do you really want to delete it and all its associated links ? ");
                if (result != false) {
                    $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: '/admin/ajaxDeleteTopic/' + id,
                        success: function(data) {
                            if (data.error != false) {
                                alert("Delete Success")
                                location.reload();
                                return 1;
                            }
                            return alert("Delete Fail");
                        }
                    })
                }
                return false;
            }
            $('.nameTopic').keyup(function() {
                var name = $(this).val();
                if (name == '') {
                    return false;
                }
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '/admin/add-topic/' + name,
                    success: function(data) {
                        if (Object.values(data).length == '') {
                            $('.wp-submit-add-topic').html(
                                '<button type="submit" class="btn btn-primary" id="submit-add-topic">Save changes</button>'
                            );
                            $('.wp-icon-check').html(
                                ' <i class="fa-solid fa-circle-check"style="color: var(--blue);line-height: 38px;margin-left: 5px;"></i>'
                            )

                        } else {
                            $('#submit-add-topic').remove();
                            $('.wp-icon-check').html(
                                '<i class="fa-solid fa-circle-exclamation" style="color: var(--red);line-height: 38px;margin-left: 5px;"></i>'
                            )
                        }


                    }
                })
            })
        </script>
    @endsection
