@extends('admin.inc.main')
@section('content')
    <div class="content">
        @include('admin.inc.navbar')
        <div class="container-fluid pt-4 px-4">
            <div class="row  bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 text-center">
                    <h3>ADD TOPIC</h3>
                    <form action="/admin/add-topic" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" id="newNameCategory"
                                placeholder="name topic - category" required>
                            <div class="icon-check"></div>
                            <label for="newNameCategory">Name</label>
                        </div>
                        <button id="button-add" type="submit" class="btn btn-primary">ADD SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
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
                    if (Object.values(data).length == '') {
                        $('#button-add').attr('disabled', false);
                        $('.icon-check').hide().html(
                            '<i class="fas fa-check" style="color: #33ed53;font-size: 24px;line-height: 38px;margin-left: 5px;"></i>'
                        ).fadeIn(500);
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
    @include('admin.inc.alert')
@endsection
