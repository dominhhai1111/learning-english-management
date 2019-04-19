@extends('webview/user/layout')

@section('head-script')
    <link href="../css/tests/test.css" rel="stylesheet" />
@endsection

@section('page-inner')
    <div class="photograph-test container text-center">
        <p class="title row">{{ $test['name'] }}</p>
        <div class="test-screen">
            @foreach($questions as $question)
                <div class="row">
                    <div class="col-md-12">
                        <p class="description">{{ $question['description'] }}</p>
                    </div>
                </div>
                <div class="row audio-area">
                    <div class="col-md-12">
                        <audio controls>
                            <source src="/{{ $question['radio_link'] }}" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
                <div class="question-area">
                    @foreach($question['children'] as $key => $child)
                        @if(($key + 1) % LIMIT_PER_PAGE_PHOTOGRAPH == 1)
                            <div class="page page_{{(int)(($key + 1) / LIMIT_PER_PAGE_PHOTOGRAPH) + 1}}" style="display: none">
                                @endif
                                <div class="row question" correct-answer="{{$child['correct_answer']}}">
                                    <div class="row image-area">
                                        <img src="/{{ $child['image_link'] }}" alt="" width="200px" height="160px">
                                    </div>
                                    <div class="row choices">
                                    <span class="choice-area">
                                        <span class="radio-check radio-check-A"></span>
                                        <input type="radio" class="choice radio-inline" name="questions[{{$child['id']}}][option]" value="A">A
                                    </span>
                                    <span class="choice-area">
                                        <span class="radio-check radio-check-B"></span>
                                        <input type="radio" class="choice radio-inline" name="questions[{{$child['id']}}][option]" value="B">B
                                    </span>
                                    <span class="choice-area">
                                        <span class="radio-check radio-check-C"></span>
                                        <input type="radio" class="choice radio-inline" name="questions[{{$child['id']}}][option]" value="C">C
                                    </span>
                                    <span class="choice-area">
                                        <span class="radio-check radio-check-D"></span>
                                        <input type="radio" class="choice radio-inline" name="questions[{{$child['id']}}][option]" value="D">D
                                    </span>
                                    </div>
                                </div>
                                @if(($key + 1) % LIMIT_PER_PAGE_PHOTOGRAPH == 0 || ($key + 1) == sizeof($question['children']))
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row choose-questions">
                    <span class="btn btn-success btn-back">Back</span>
                    <select name="" id="" class="btn btn-success select-page">
                        @foreach($question['children'] as $key => $child)
                            @if(($key + 1) % LIMIT_PER_PAGE_PHOTOGRAPH == 1)
                                <option value="{{(int)(($key + 1) / LIMIT_PER_PAGE_PHOTOGRAPH) + 1}}">
                                    @if($key + LIMIT_PER_PAGE_PHOTOGRAPH <= sizeof($question['children']))
                                        Questions {{$key + 1}} - {{$key + LIMIT_PER_PAGE_PHOTOGRAPH}}
                                    @elseif($key + 1 == sizeof($question['children']))
                                        Question {{$key + 1}}
                                    @else
                                        Questions {{$key + 1}} - {{$key + LIMIT_PER_PAGE_PHOTOGRAPH}}
                                    @endif
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <span class="btn btn-success btn-next">Bext</span>
                </div>
                <div class="row control-area">
                    <span class="btn btn-success btn-submit">Submit</span>
                    <div class="result" style="display: none">
                        <p class="btn btn-success btn-show-answer">Show answers</p>
                        <p>Correct: <span class="score"></span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('bottom-script')
    <script src="../js/tests/test.js"></script>
@endsection