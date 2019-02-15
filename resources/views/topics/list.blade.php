@extends('layout')

@section('page-inner')
	<div id="page-inner">
		<div class="row">
			<div class="col-lg-12">
				<h2>ADMIN DASHBOARD</h2>
			</div>
		</div>
		<hr />
		<div class="row">
			@foreach ($topics as $topic)
				<p style="margin: 0">{{$topic['name']}}</p>
			@endforeach
		</div>
	</div>
@endsection

