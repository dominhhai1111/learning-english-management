@extends('layout')

@section('page-inner')
    <div id="page-inner">
        <div class="row">
            <div class="title-page col-lg-12">
                <h2>Edit test</h2>
            </div>
        </div>
        <div class="row">
            <div class="box box-primary col-lg-12">
                <!-- form start -->
                <form role="form" method="post" action="" enctype="multipart/form-data">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name"
                                   value="@if(!empty($test['name'])){{$test['name']}}@endif">
                        </div>
                        <div class="form-group">
                            <label for="name">Topic</label>
                            <input type="text" value="{{$topic['name']}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="image_link">Image input</label>
                            <input type="file" name="image" id="inputImage">
                        </div>
                        <div class="form-group">
                            <label for="">Quesions</label>
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
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('bottom-script')
    <link rel="stylesheet" href="../AdminLTE/css/AdminLTE.min.css">
    <link href="../DataTables/datatables.css" rel="stylesheet" />
    {{--<link href="../css/questions/list.css" rel="stylesheet" />--}}
    <script src="../DataTables/datatables.js"></script>
    <script src="../js/tests/edit.js"></script>
@endsection