@extends('webview/user/layout')

@section('page-inner')
    <div class="webview-container topic-list">
        @foreach ($tests as $test)
            <div class="row topic-area" onclick="goToTest({{$test['id']}})">
                <div class="col-xs-5 image-area">
                    <img src="{{URL::to('/') . '/' . $test['image_link']}}" alt="">
                </div>

                <div class="col-xs-7 title-area">
                    {{ $test['name'] }}
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function goToTest(id) {
            window.location.href = '/user/test?id=' + id;
        }
    </script>
@endsection