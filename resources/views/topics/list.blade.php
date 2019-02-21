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
			<div class="table-area">
				<table id="topics-table" class="display">
					<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($topics as $topic)
						<tr>
							<td>{{$topic['id']}}</td>
							<td>{{$topic['name']}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('bottom-script')
	<link href="../css/DataTables/datatables.css" rel="stylesheet" />
	<link href="../css/Topics/list.css" rel="stylesheet" />
	<script src="../js/DataTables/datatables.js"></script>
	<script src="../js/topics/list.js"></script>
@endsection
