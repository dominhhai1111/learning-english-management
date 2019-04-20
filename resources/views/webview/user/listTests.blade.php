@extends('webview/user/layout')

@section('page-inner')
    <div class="webview-container topic-list">
        @foreach ($tests as $test)
            <div class="row topic-area" onclick="goToTest({{$test['id']}})">
                <div class="col-xs-5 image-area">
                    <img src="{{URL::to('/') . '/' . $test['image_link']}}" alt="">
                </div>

                <div class="col-xs-7 discription-area">
                    <p class="title">{{ $test['name'] }}</p>
                    <p class="score">Score:
                        @if(!empty($test['highest_score']))
                        <span>{{$test['highest_score']}}/{{$test['total_score']}}</span>
                        @endif
                    </p>
                    <p class="time">Time:
                        @if(isset($test['time']))
                            <span>{{$test['time']}} minutes</span>
                        @endif
                    </p>
                    <p class="created">
                        @if(isset($test['record_created']))
                            <span>{{$test['record_created']}}</span>
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function goToTest(id) {
            window.location.href = '/user/test?id=' + id + '&remember_token=' + "{{$user['remember_token']}}";
        }
    </script>
@endsection