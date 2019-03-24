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
            @foreach($question['children'] as $child)
                <div class="row question">
                    <div class="row image-area">
                        <img src="/{{ $child['image_link'] }}" alt="" width="200px" height="160px">
                    </div>
                    <div class="row choices">
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="A" checked>A
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="B">B
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="C">C
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="D">D
                    </div>
                </div>
                <div class="row question">
                    <div class="row image-area">
                        <img src="/{{ $child['image_link'] }}" alt="" width="200px" height="160px">
                    </div>
                    <div class="row choices">
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="A" checked>A
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="B">B
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="C">C
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="D">D
                    </div>
                </div>
                <div class="row question">
                    <div class="row image-area">
                        <img src="/{{ $child['image_link'] }}" alt="" width="200px" height="160px">
                    </div>
                    <div class="row choices">
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="A" checked>A
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="B">B
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="C">C
                        <input type="radio" name="questions[{{$question['id']}}][option]" value="D">D
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="../js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="../js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="../js/custom.js"></script>
@yield('bottom-script')
</body>
</html>
