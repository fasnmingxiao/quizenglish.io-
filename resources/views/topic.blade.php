@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            <div class="col">
                @include('breadcumb')
                <br>
                @include('alert')
                <div class="quizzes">
                </div>
                <div class="quizzes_search">
                    <div class="bg-fluid">
                    </div>
                    <div class="head">Please choose topic to start learn</div>
                    <div class="search--wrapper">
                        <input type="search" id="mem_search" name="key_search" class="input_search" placeholder="Search">
                        <button type="button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <img class="search_img" src="{{ asset('template/img/Group 35.png') }}" alt="">
                </div>
                @if (count($listTopic) > 0)
                    @foreach ($listTopic as $item)
                        @if ($item['parent_id'] == 0)
                            <div class="quizzes_section">
                                <div class="quizzes_section_head">
                                    {{ $item['name'] }}
                                </div>
                                <div class="row quizz_wrapper">
                                    @foreach ($listTopic as $subItem)
                                        @if ($subItem['parent_id'] == $item['id'])
                                            <div class="quizz_item">
                                                <div class="quizzes_section_item ">
                                                    <a class="quizzes_section_item_img"
                                                        href="{{ $subItem->id }}/Category-detail">
                                                        <img src="/storage/images/category/{{ $subItem['thumb'] }}"
                                                            alt="" class="img">

                                                    </a>
                                                    <div class="sub_content">
                                                        <p class="text_head">{{ $subItem['name'] }}</p>
                                                        <div class="text_sub">
                                                            {{ $subItem['description'] }}
                                                        </div>
                                                        <div class="wrap">
                                                            <div class="lession">
                                                                {{ count($subItem->quizCategory) }} lession
                                                            </div>
                                                            @if (check_Cat_Reg($listCatReg, $subItem->id) != null)
                                                                <a class="add" style="background: tomato;"
                                                                    href="/myquiz">
                                                                    Go to My Quiz
                                                                    <i class="fas fa-chevron-right"></i>
                                                                </a>
                                                            @else
                                                                <a class="add"
                                                                    href="/addCatToMyQuiz/{{ $subItem->id }}">
                                                                    Add Quiz
                                                                    <i class="fas fa-plus"></i>
                                                                </a>
                                                            @endif

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
                @else
                    <h1 class="nodata">No data found :| </h1>
                @endif

            </div>
        </div>

    </div>
    </div>
@endsection
@section('footer')
    <script>
        $('#mem_search').on('change', function() {
            var key = $(this).val();
            window.location.replace("/topic/" + key);
        })
    </script>
@endsection
