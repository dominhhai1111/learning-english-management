@extends('questions.add')

@section('title')
    <h2>Import</h2>
    @endsection


    @section('content')
            <!-- form start -->
    <form role="form" method="post" action="" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="box-body">
            <div class="form-group">
                <label for="name">Part</label>
                <select name="part_id" class="form-control" id="addTopicId">
                    @foreach ($topics as $topic)
                        <option value="{{$topic['id']}}">{{$topic['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">File</label>
                <input type="file" name="file" class="form-control">
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

@section('bottom-script')
    <link href="../DataTables/datatables.css" rel="stylesheet" />
    <link href="../css/questions/list.css" rel="stylesheet" />
    <script src="../DataTables/datatables.js"></script>
@endsection