@extends('webview/user/layout')

@section('page-inner')
    <div class="user-info text-right">
		<span>
			@if (!empty($user['name']))
                User name: {{$user['name']}}
            @endif
		</span>
    </div>
    <div class="webview-container topic-list">
        @foreach ($tests as $test)
            <div class="row topic-area" onclick="goToTest({{$test['id']}})">
                <div class="col-xs-5 image-area">
                    <img src="{{URL::to('/') . '/' . $test['image_link']}}" alt="">
                </div>

                <div class="col-xs-7 discription-area">
                    <p class="title">{{ $test['name'] }}</p>
                    <p class="score">Score: </p>
                    <p class="time">Time: </p>
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