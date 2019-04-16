@extends('webview/user/layout')

@section('page-inner')
	<div class="webview-container topic-list">
		@foreach ($topics as $topic)
			<div class="row topic-area">
				<div class="col-xs-5 image-area">
					<img src="{{URL::to('/') . '/' . $topic['image_link']}}" alt="">
				</div>

				<div class="col-xs-7 title-area">
					{{ $topic['name'] }}
				</div>
			</div>
		@endforeach
	</div>
@endsection