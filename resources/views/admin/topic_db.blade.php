@extends('admin.inc.main')

@section('content')
    <div class="content">
        @include('admin.inc.navbar')
        <div class="container-fluid pt-4 px-4">
            <div class="row bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4 text-center title-table">Topic & category</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Thumb</th>
                                        <th scope="col">Created_at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{ tree_topic($data) }}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-container">
        <div class="modal-background">
            <div class="modal" style=" border-radius: 50px;">
                <div class="modal-title">
                    UPDATE TOPIC & CATEGORY
                </div>
                <div class="report-content">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">UPDATE TOPIC & CATEGORY</h6>
                        <form action="/admin/UpdateCategory" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="idcat" id="idcat">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="newNameCategory" id="newNameCategory"
                                    placeholder="name topic - category">
                                <label for="newNameCategory">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Description category" id="newDesCategory" name="newDesCategory"
                                    style="height: 150px;"></textarea>
                                <label for="newDesCategory">Description</label>
                            </div>
                            <select id="TopicName" name="topic" class="form-select mb-3">
                                <option selected="">Choose Topic</option>
                                @if (count($listTopic) > 0)
                                    @foreach ($listTopic as $value)
                                        @if ($value['parent_id'] == 0)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <input type="hidden" name="old_thumb" class="old_thumb">
                            <div class="row mb-3" id="UploadNewThumb">
                                <label for="newThumbCategory" class="form-label"></label>
                                <input class="form-control bg-dark" type="file" id="newThumbCategory" name="file"
                                    onchange="filePreview(this)">
                            </div>
                            <div class="row mb-3">
                                <img class="rounded" style="margin:0 auto;width:150px" height="auto" id="showThumb">
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
    {{-- Edit --}}
    <script>
        $('#cat_topic').addClass('active');
        $('.edit-button').on('click', function() {
            $("#modal-container").removeAttr("class").addClass("two");
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: '/admin/ajaxGetCategory/' + id,
                success: function(data) {

                    if (data['parent_id'] != 0) {
                        $('#newThumb').remove();
                        $('#newNameCategory').attr('disabled', false);
                        $('#newThumbCategory').attr('disabled', false)
                        $("#newNameCategory").css("display", "block");
                        $("#newThumbCategory").css("display", "block");
                        $('#showThumb').attr('src', 'http://quizzeng.com/storage/images/category/' +
                            data['thumb']);
                        $(`#TopicName option[value = ${data['parent_id']}] `).attr('selected',
                            'selected');
                        $('.old_thumb').val(data['thumb']);
                        $('#newDesCategory').css('display', 'block');
                        $('#newDesCategory').val(data['description']);
                    } else {
                        $('#TopicName').attr('disabled', 'disabled');
                        $('#newThumbCategory').attr('disabled', 'disabled')
                        $("#TopicName").css("display", "none");
                        $("#newThumbCategory").css("display", "none");
                        $('#showThumb').attr('src', '');
                        $('#newDesCategory').css('display', 'none');
                    }
                    $('#newNameCategory').val(data['name']);
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
            var result = confirm("Do you really want to delete it and all its associated links ? ");
            if (result != false) {
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '/admin/ajaxDeleteTopic/' + id,
                    success: function(data) {
                        if (data.error != false) {
                            toastr.success('Delete row success!');
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                        toastr.error('Delete row fail!');
                        window.setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                })
            }
            return false;
        }
    </script>
    {{-- end delete --}}
    @include('admin.inc.alert')
@endsection
