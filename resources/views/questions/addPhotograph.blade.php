@extends('questions.add')

@section('title')
    <h2>Add new photograph question</h2>
@endsection


@section('content')
<!-- form start -->
<form role="form" method="post" action="" enctype="multipart/form-data">
    @csrf <!-- {{ csrf_field() }} -->
    <input type="hidden" name="questionType" value="photograph">
    <div class="box-body">
        <div class="form-group">
            <label for="name">Topic</label>
            <input type="text" name="topic" class="form-control" value="Photograph" readonly>
        </div>
        <div class="form-group">
            <label for="name">Description</label>
            <input type="text" name="description" class="form-control" placeholder="Enter description">
        </div>
        <div class="form-group">
            <label for="name">Radio</label>
            <input type="file" name="radio_link" class="form-control">
        </div>
        <div class="form-group">
            <p class="btn-primary btn btn-add">Add more question</p>
        </div>
        <div class="question-area">

        </div>
        <div class="question-template-area">
            <div class="question-template" style="display: none">
                <div class="form-group">
                    <label for="image_link">Image input</label>
                    <input type="file" name="questionsTmp[questionNo][image]" class="questionsTmp_questionNo" onchange="readURL(this)">
                    <img style="width: 300px; height: 200px" class="questionsTmp_questionNo_show" src="#" alt="your image" />
                </div>
                <div class="form-group">
                    <label for="">Options</label>
                    <input type="radio" name="questionsTmp[questionNo][option]" value="A" checked>A
                    <input type="radio" name="questionsTmp[questionNo][option]" value="B">B
                    <input type="radio" name="questionsTmp[questionNo][option]" value="C">C
                    <input type="radio" name="questionsTmp[questionNo][option]" value="D">D
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection

@section('bottom-script')
    <link href="../DataTables/datatables.css" rel="stylesheet" />
    <link href="../css/questions/list.css" rel="stylesheet" />
    <script src="../DataTables/datatables.js"></script>
    <script src="../js/questions/add_photograph.js"></script>
@endsection