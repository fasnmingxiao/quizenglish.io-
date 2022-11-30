@extends('admin.inc.main')
@section('content')
    <div class="content">
        @include('admin.inc.navbar')
        <div class="container-fluid pt-4 px-4">
            <div class="row bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 text-center">
                    <h3>ADD CATEGORY</h3>
                    <form action="/admin/add-category" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="categoryName" id="categoryName"
                                placeholder="name topic - category" value="{{ old('categoryName') }}" required>
                            <label for="newNameCategory">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Description category" id="description" name="description"
                                style="height: 150px;" required>{{ old('description') }}</textarea>
                            <label for="newDesCategory">Description</label>
                        </div>
                        <select id="topic" name="topic" class="form-select mb-3" required>
                            <option value="">Choose Topic</option>
                            @if (count($data) > 0)
                                @foreach ($data as $value)
                                    @if ($value['parent_id'] == 0)
                                        <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <div class="row mb-3" id="UploadNewThumb">
                            <label for="newThumbCategory" class="form-label"></label>
                            <input class="form-control bg-dark" type="file" id="file" name="file"
                                onchange="loadFile(event)" accept="image/*" required>
                            <img id="img_output" style="    margin: 0 auto;padding-top: 21px;" src="" alt=""
                                srcset="">
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
                        <button type="submit" class="btn btn-primary">ADD SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('#cat_topic').addClass('active');
    </script>
    @include('admin.inc.alert')
@endsection
