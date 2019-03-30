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
                            <button type="button" class="btn btn-info btn-add-question">Add question</button>
                            <input type="number" class="question_id">
                        </div>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Latest Orders</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Item</th>
                                            <th>Status</th>
                                            <th>Popularity</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="question-table-body">
                                        @foreach ($questions as $question)
                                            <tr class="question_{{$question['id']}}">
                                                <input type="hidden" name="questions[]" value="{{$question['id']}}">
                                                <td>{{$question['id']}}</td>
                                                <td>{{substr($question['description'], 0, 20)}}</td>
                                                <td>{{$question['topic_name']}}</td>
                                                <td>{{$question['level']}}</td>
                                                <td><p class="btn btn-danger" onclick="removeQuestion({{$question['id']}})">Delete</p></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
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