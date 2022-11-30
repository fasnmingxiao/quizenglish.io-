@extends('main')
@section('content')
    <div class="main">
        <div class="container">
            @include('breadcumb')
            <div class="text_heading">Choose Quizz</div>
            <div class="choose_quizz">
                <div class="list-item">
                    {{-- lam roi thi them class active-item --}}
                    @if (count($listQuiz) > 0)
                        @foreach ($listQuiz as $item)
                            @if (count($item['question']) > 0)
                                <a href="/start/{{ $item['id'] }}"
                                    class="item {{ check_quiz_done($listDone, $item['id']) }}">
                                    <div class="name">{{ $item['name'] }} ({{ count($item['question']) }}
                                        question)</div>
                                    {!! check_quiz_icon_done($listDone, $item['id']) !!}
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
