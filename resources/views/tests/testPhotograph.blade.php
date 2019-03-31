<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../css/custom.css" rel="stylesheet" />

    <link href="../css/Tests/test.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    @yield('head-script')
</head>
<body>
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
                                    <input type="radio" class="choice" name="questions[{{$question['id']}}][option]" value="A">A
                                    <input type="radio" class="choice" name="questions[{{$question['id']}}][option]" value="B">B
                                    <input type="radio" class="choice" name="questions[{{$question['id']}}][option]" value="C">C
                                    <input type="radio" class="choice" name="questions[{{$question['id']}}][option]" value="D">D
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
            <div class="row">
                <span class="btn btn-success btn-submit">Submit</span>
            </div>
        @endforeach
    </div>
    <div class="result-screen" style="display: none">
        <div class="result">
            <p>Correct: <span class="score"></span></p>
        </div>
    </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="../js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="../js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="../js/custom.js"></script>

<script src="../js/tests/test.js"></script>
@yield('bottom-script')
</body>
</html>
