@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            @include('breadcumb')
            <br>
            @include('alert')
            <div class="text_heading">Quiz Detail</div>
            <div class="quizz_details">
                <div class="item">
                    <img src="/storage/images/category/{{ $data->thumb }}" alt="">
                    <div class="wrap_1" style="width:100%">
                        <div class="text_head">
                            {{ $data->name }}
                        </div>
                        <div class="text_sub">
                            {{ $data->description }}
                        </div>
                        <div class="wrap-2" style="width:100%">
                            <div class="lession">
                                {{ count($data->quizCategory) }} lession
                            </div>

                            @if (Auth::check())
                                @if (check_Cat_Reg($listCatReg, $data->id) != null)
                                    <div class="add" style="background: var(--red);">
                                        <a href="/myquiz" class="text-while" style="color:var(--white);">Go to My Quiz
                                            <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                @else
                                    <div class="add">
                                        <a href="/addCatToMyQuiz/{{ $data->id }}" class="text-while"
                                            style="color:var(--white);">
                                            Add Quiz
                                            <i class=" fas fa-plus"></i>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="btn-wn">
                                    Please login to continue
                                </div>
                            @endif

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
