@extends('webview/user/layout')

@section('page-inner')
	<style>

	</style>
	<div class="webview-container">
		@foreach ($topics as $topic)
			<div class="row">
				<div class="col-xs-5">
					<img src="/img/photograph.jpg" alt="">
				</div>

				<div class="col-xs-7">
					{{ $topic['name'] }}
				</div>
			</div>
		@endforeach
	</div>
@endsection