@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-1 ">
                        <div class="section-1_text">
                            <div class="section-1_text-head">
                                Learn new concepts each minute
                            </div>
                            <div class="section-1_text-sub">
                                We help you prepare for exams and quizes
                            </div>
                        </div>
                        <img class="section-1_img" src="{{ asset('/template/img/Illusttration.png') }}" alt="...">
                        <div class="section-1_btn">
                            <a href="" class="section-1_btn--bg_blue">Let’s start</a>
                            <a href="" class="section-1_btn--bg_white"><i class="fa-solid fa-caret-down"></i>know
                                more</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row" id="features">
                <div class="col">
                    <div class="section-2">
                        <img src="{{ asset('/template/img/Vector 4.png') }}" alt="" class="   vector_top">
                        <img src="{{ asset('/template/img/Vector 5.png') }}" alt="" class="   vector_bot">
                        <div class="section-2_main row">
                            <div class="section-2_head">
                                QuizzEng comes with
                                amazing <p style="color: var(--blue); display: inline-block;">features </p> like:
                            </div>
                            <div class="item--wrapper">
                                <div class="item">
                                    <div class="width_100_mobile"><img src="{{ asset('/template/img/Group 23.png') }}"
                                            class="  item_icon"></div>


                                    <div class="item_head">
                                        3D Coverage
                                    </div>
                                    <div class="item_sub">
                                        3 dimensional coverage of all questions related
                                        to a perticular topic
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="width_100_mobile"><img src="{{ asset('/template/img/Group 24.png') }}"
                                            class="  item_icon"></div>

                                    <div class="item_head">
                                        Plenty of subjects
                                    </div>
                                    <div class="item_sub">
                                        Plenty of subjects to choose from for e.g. Computer languages, Engineering subjects
                                        etc.
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="width_100_mobile"><img src="{{ asset('/template/img/Group 25.png') }}"
                                            class="item_icon"></div>

                                    <div class="item_head">
                                        Detailed solutions
                                    </div>
                                    <div class="item_sub">
                                        Detailed explaination of a solution is provided to get depper understanding of a
                                        topic
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row" id="howitworks">
                <div class="col">
                    <div class="section-3">
                        <div class="section-3_head">
                            Let’s checkout your
                            <p style="color: var(--blue); display: inline-block;">learning </p>
                            journey
                        </div>
                        <div class="section-3--wrapper">
                            <div class="item--wrapper">
                                <div class="item">
                                    <div class="item_num">1<p style="display: inline; color:#34AEFF;">.</p>
                                    </div>
                                    <div class="item_head">
                                        Choose your subject
                                    </div>
                                    <div class="item_sub">
                                        Choose your favourite subject
                                        from the vast selection of subjects
                                        and continnue your journey
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item_num">2<p style="display: inline; color:#34AEFF;">.</p>
                                    </div>
                                    <div class="item_head">
                                        Select the difficulty
                                    </div>
                                    <div class="item_sub">
                                        Select difficulty of your choice
                                        and get the difficulty of questions
                                        according to your difficulty
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item_num">3<p style="display: inline; color:#34AEFF;">.</p>
                                    </div>
                                    <div class="item_head">
                                        Increasing difficulty
                                    </div>
                                    <div class="item_sub">
                                        Difficulty of questions will increase for the upcoming question irrespective of
                                        result
                                        of a previous question
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item_num">4<p style="display: inline; color:#34AEFF;">.</p>
                                    </div>
                                    <div class="item_head">
                                        Detailed overview of scores
                                    </div>
                                    <div class="item_sub">
                                        Get the detailed overview of
                                        your question answer session
                                        and tips on how you can improve
                                    </div>
                                </div>
                            </div>
                            <div class="icon--wrapper">
                                <img class="icon-1" src="{{ asset('template/img/Group 26.png') }}" alt="">
                                <img class="icon-2" src="{{ asset('template/img/Group 27.png') }}" alt="">
                                <img class="icon-3" src="{{ asset('template/img/Group 28.png') }}" alt="">
                                <img class="icon-4" src="{{ asset('template/img/Group 29.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('admin.inc.alert')
@endsection
