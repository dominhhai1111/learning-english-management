@extends('webview/user/layout')

@section('head-script')
    <link href="../css/tests/test.css" rel="stylesheet" />
@endsection

@section('page-inner')
    <div class="incomplete-sentences-test container text-center">
        <p class="title row">{{ $test['name'] }}</p>
        <div class="test-screen">
            <div class="question-area text-left">
                @foreach($questions as $key => $question)
                    @if(($key + 1) % LIMIT_PER_PAGE_INCOMPLETE_SENTENCES == 1)
                        <div class="page page_{{(int)(($key + 1) / LIMIT_PER_PAGE_INCOMPLETE_SENTENCES) + 1}}" style="display: none">
                            @endif
                            <div class="row question" correct-answer="{{$question['correct_answer']}}">
                                <div class="question-content">
                                    <label for="">Question {{$key + 1}}: </label>{{ $question['question'] }}
                                </div>
                                <div class="choices">
                                    <p class="choice-area">
                                        <span class="radio-check radio-check-A"></span>
                                        <input type="radio" class="choice radio-inline" name="questions[{{$question['id']}}][option]" value="A">
                                        <span>{{$question['answers']['A']}}</span>
                                    </p>
                                    <p class="choice-area">
                                        <span class="radio-check radio-check-B"></span>
                                        <input type="radio" class="choice radio-inline" name="questions[{{$question['id']}}][option]" value="B">
                                        <span>{{$question['answers']['B']}}</span>
                                    </p>
                                    <p class="choice-area">
                                        <span class="radio-check radio-check-C"></span>
                                        <input type="radio" class="choice radio-inline" name="questions[{{$question['id']}}][option]" value="C">
                                        <span>{{$question['answers']['C']}}</span>
                                    </p>
                                    <p class="choice-area">
                                        <span class="radio-check radio-check-D"></span>
                                        <input type="radio" class="choice radio-inline" name="questions[{{$question['id']}}][option]" value="D">
                                        <span>{{$question['answers']['D']}}</span>
                                    </p>
                                </div>
                            </div>
                            @if(($key + 1) % LIMIT_PER_PAGE_INCOMPLETE_SENTENCES == 0 || ($key + 1) == sizeof($questions))
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="row choose-questions">
                <span class="btn btn-success btn-back">Back</span>
                <select name="" id="" class="btn btn-success select-page">
                    @foreach($questions as $key => $question)
                        @if(($key + 1) % LIMIT_PER_PAGE_INCOMPLETE_SENTENCES == 1)
                            <option value="{{(int)(($key + 1) / LIMIT_PER_PAGE_INCOMPLETE_SENTENCES) + 1}}">
                                @if($key + LIMIT_PER_PAGE_INCOMPLETE_SENTENCES <= sizeof($questions))
                                    Questions {{$key + 1}} - {{$key + LIMIT_PER_PAGE_INCOMPLETE_SENTENCES}}
                                @elseif($key + 1 == sizeof($questions))
                                    Question {{$key + 1}}
                                @else
                                    Questions {{$key + 1}} - {{$key + LIMIT_PER_PAGE_INCOMPLETE_SENTENCES}}
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
        </div>
    </div>
    <script>
        var test = <?php echo json_encode($test); ?>;
    </script>
@endsection

@section('bottom-script')

@endsection