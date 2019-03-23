@extends('layout')

@section('page-inner')
	<div id="page-inner">
		<div class="row">
			<div class="col-lg-12">
				<h2>Question List</h2>
			</div>
		</div>
		<hr />
		<div class="row" style="padding: 0 60px">
			<div class="col-xs-3 col-xs-push-7">
				<select name="add_topic_id" class="form-control" id="addTopicId">
					@foreach ($topics as $topic)
						<option value="{{$topic['id']}}">{{$topic['name']}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-xs-2 col-xs-push-7">
				<button type="button" class="btn btn-primary btn-add" onclick="addQuestion()">Add</button>
			</div>
		</div>
		<div class="row">

			<div class="table-area">
				<table id="questions-table" class="display">
					<thead>
					<tr>
						<th>ID</th>
						<th>Descriptions</th>
						<th>Topic</th>
						<th>Level</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($questions as $question)
						<tr>
							<td>{{$question['id']}}</td>
							<td>{{$question['description']}}</td>
							<td>{{$question['topic_name']}}</td>
							<td>{{$question['level']}}</td>
							<td><button type="button" class="btn btn-success" onclick="location.href='/questions/edit?id={{$question['id']}}'">Edit</button>
								<button type="button" id="btnDelete" class="btn btn-danger" onclick="confirmDeleteTest({{$question['id']}})">Delete</button>
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
	<link href="../css/questions/list.css" rel="stylesheet" />
	<script src="../DataTables/datatables.js"></script>
	<script src="../js/questions/list.js"></script>
@endsection
