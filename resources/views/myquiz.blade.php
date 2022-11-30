@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            @include('breadcumb')
            <br>
            @include('alert')
            <div class="my_quizz_section-1">
                <div class="text_heading">My Quiz</div>
                <div class="wrapper_item_head">
                    <div class="search--wrapper">
                        <input type="text" id="mem_search" name="key_search" class="input_search" placeholder="Search">
                        <button type="button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="search--content">
                        <div>

                        </div>
                    </div>
                    <a class="add" href="/topic">
                        Add Quiz
                        <i class="fas fa-plus"></i>
                    </a>
                </div>

            </div>
            {{-- $("#search").on('keyup',function(){
    console.log($(this).val());
}) --}}
            <div class="my_quizz_section-2">
                <div class="quizzes_section">
                    @if (count($listMyQuiz) > 0)
                        <div class="row">
                            @foreach ($listMyQuiz as $item)
                                <div class="c-4">
                                    <div class="quizzes_section_item ">
                                        <img src="{{ url('/storage/images/category/' . $item['thumb']) }}" alt=""
                                            class="img">
                                        <div class="sub_content_myquiz">
                                            <p class="text_head">{{ $item['name'] }}</p>
                                            <div class="text_sub">
                                                {{ $item['description'] }}
                                            </div>
                                            <div class="process_bar">
                                                <div id="process_bar_id" class="process_bar_in"
                                                    style="width:80%; position:relative;">
                                                    <div class="process_complete"
                                                        style="position: absolute;right: -10px;color: var(--blue);top: -20px;font-size: 16px;">
                                                        80%</div>

                                                </div>
                                            </div>
                                            <div class="wrap">
                                                <a href="/{{ $item->id }}/chooseQuiz" class="start">
                                                    <img src="{{ url('/template/img/Start.png') }}" alt="">
                                                </a>

                                                <a href="/{{ $item->id }}/chooseQuiz" class="start"
                                                    style="font-size:25px;">
                                                    <i class="fa-solid fa-list"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    @else
                        <!-- when no quizz -->
                        <div class="nodata">
                            Please add quiz to get started...
                        </div>
                    @endif

                </div>


            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        // SEARCH
        $("#mem_search").keyup(function() {
            var key_search = $(this).val();
            if (key_search == '') {
                $('.quizzes_section').html('<div class="loader"></div>');
                setTimeout(load_data('none'), 3000);
            }
            if (key_search == 0) {
                return false;
            }
            $('.quizzes_section').html('<div class="loader"></div>');
            setTimeout(load_data(key_search.trim()), 3000);


        });

        function load_data(key) {
            $.ajax({
                type: "GET",
                dataType: "JSON",
                'url': '/category/search/' + key,
                success: function(rs) {
                    if (rs == '') {
                        $('.quizzes_section').html(
                            '<h1 class="nodata" >No data found! <i style="color: yellow;" class="fas fa-sad-tear"></i></h1>'
                        )
                    } else {
                        html = '<div class="row">';
                        rs.map(function(item) {
                            html += '<div class="c-4">';
                            html += '<div class="quizzes_section_item ">';
                            html += '<img src="/storage/images/category/' + item.thumb +
                                '"class = "img" >';
                            html += '<div class="sub_content_myquiz">'
                            html += '<p class="text_head">' + item.name + '</p>';
                            html += '<div class="text_sub">' + item.description + '</div>'
                            html += ' <div class="process_bar">';
                            html +=
                                '<div id="process_bar_id" class="process_bar_in" style="width:80%; position:relative;">';
                            html +=
                                '<div class="process_complete" style ="position: absolute;right: -10px;color: var(--blue);top: -20px;font-size: 16px;" >80% </div>';
                            html += '</div> </div>';
                            html += '<div class="wrap">';
                            html += '<a href="/' + item.id +
                                '/chooseQuiz" class="start"><img src = "/template/img/Start.png" > </a>';
                            html += '<a href="/' + item.id +
                                '/chooseQuiz" class="start" style="font-size:25px;"><i class="fa-solid fa-list"></i></a>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        });
                        html += '</div>';
                        $('.quizzes_section').html(html);
                    }
                }
            })
        }
    </script>
@endsection
