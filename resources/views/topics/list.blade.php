@extends('layout')

@section('page-inner')
	<div id="page-inner">
		<div class="row">
			<div class="col-lg-12">
				<h2>Topics List</h2>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-lg-offset-10">
				<button type="button" class="btn btn-primary btn-add">Add</button>
			</div>
		</div>
		<div class="row">
			<div class="table-area">
				<table id="topics-table" class="display">
					<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($topics as $topic)
						<tr>
							<td>{{$topic['id']}}</td>
							<td>{{$topic['name']}}</td>
							<td><button type="button" class="btn btn-success">Edit</button><button type="button" class="btn btn-danger">Delete</button></td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('bottom-script')
	<link href="../DataTables/datatables.css" rel="stylesheet" />
	<link href="../css/Topics/list.css" rel="stylesheet" />
	<script src="../DataTables/datatables.js"></script>
	<script src="../js/topics/list.js"></script>
@endsection
