@extends('layout')

@section('page-inner')
	<div id="page-inner">
		<div class="row">
			<div class="col-lg-12">
				<h2>Tests List</h2>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="btn-add-area">
				<button type="button" class="btn btn-primary btn-add" onclick="location.href='/tests/add'">Add</button>
			</div>
		</div>
		<div class="row">

			<div class="table-area">
				<table id="tests-table" class="display">
					<thead>
					<tr>
						<th>ID</th>
						<th>Test Name</th>
						<th>Topic Name</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($tests as $test)
						<tr>
							<td>{{$test['id']}}</td>
							<td>{{$test['name']}}</td>
							<td>{{$test['topic_name']}}</td>
							<td><button type="button" class="btn btn-success" onclick="location.href='/tests/edit?id={{$test['id']}}'">Edit</button>
								<button type="button" id="btnDelete" class="btn btn-danger" onclick="confirmDeleteTest({{$test['id']}})">Delete</button>
							</td>
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
	<link href="../css/tests/list.css" rel="stylesheet" />
	<script src="../DataTables/datatables.js"></script>
	<script src="../js/tests/list.js"></script>
@endsection
