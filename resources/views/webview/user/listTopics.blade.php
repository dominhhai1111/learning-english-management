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
		@foreach ($topics as $topic)
			<div class="row topic-area" onclick="goToTestList({{$topic['id']}})">
				<div class="col-xs-5 image-area">
					<img src="{{URL::to('/') . '/' . $topic['image_link']}}" alt="">
				</div>

				<div class="col-xs-7 title-area">
					{{ $topic['name'] }}
				</div>
			</div>
		@endforeach
	</div>

	<script>
		function goToTestList(id) {
			window.location.href = '/user/list-tests?topic-id=' + id + '&remember_token=' + "{{$user['remember_token']}}";
		}
	</script>
@endsection