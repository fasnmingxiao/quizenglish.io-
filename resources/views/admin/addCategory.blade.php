@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            @include('breadcumb')
            @include('alert')
            <form action="/admin/add-category" method="POST" enctype="multipart/form-data" class="add_quizz">
                @csrf
                <div class="list">
                    <div class="name">Add topic</div>
                    <div class="topic">
                        <div class="content-wrap ">
                            <select name="topic" required>
                                <option value="">Choose Topic</option>
                                @foreach ($listTopic as $item)
                                    <option class="option" value="{{ $item->id }}">
                                        <p>{{ $item->name }}</p>
                                    </option>
                                @endforeach

                            </select>
                            <input type="text" name="categoryName" placeholder="Category title" required>
                            @error('categoryName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <textarea name="description" cols="30" rows="9" placeholder="Description"></textarea>
                        </div>
                        <div class="img-wrap">
                            <input type="file" name="file" id="file" class="inputfile"
                                data-multiple-caption="{count} files selected" multiple onchange="loadFile(event)"
                                accept="image/*" required />
                            <label id="img_base" for="file"><img id="img_output"
                                    src="{{ asset('/template/img/Vector.png') }}" alt="" srcset=""></label>
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
                    </div>
                </div>
                <button type="submit" class="submit_quizz add false">Add</button>
            </form>
        </div>
    </div>
@endsection
