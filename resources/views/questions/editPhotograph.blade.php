@extends('questions.edit')

@section('title')
    <h2>Edit photograph question</h2>
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
            <input type="text" name="description" class="form-control" placeholder="Enter description" value="{{$question['description']}}">
        </div>
        <div class="form-group">
            <label for="name">Radio</label>
            <input type="file" name="radio_link" class="form-control">
            <a href="{{URL::to('/') . '/' . $question['radio_link']}}">current file</a>
        </div>
        <div class="form-group">
            <label for="name">Difficulty</label>
            <select name="level" class="form-control">
                <option value="1" <?php if($question['level'] == 1) echo "selected"?>>Easy</option>
                <option value="2" <?php if($question['level'] == 2) echo "selected"?>>Normal</option>
                <option value="3" <?php if($question['level'] == 3) echo "selected"?>>Hard</option>
            </select>
        </div>
        <div class="form-group">
            <p class="btn-primary btn btn-add">Add more question</p>
        </div>
        <div class="question-area">
            @foreach($childrenQuestions as $question)
                <div class="form-group">
                    <label for="image_link">Image input</label>
                    <input type="file" name="questions[{{$question['id']}}][image]" class="questions_{{$question['id']}}" onchange="readURL(this)">
                    <img style="width: 300px; height: 200px" class="questions_{{$question['id']}}_show" src="{{URL::to('/') . '/' . $question['image_link']}}" alt="your image" />
                </div>
                <div class="form-group">
                    <label for="">Options</label>
                    <input type="radio" name="questions[{{$question['id']}}][option]" value="A" checked>A
                    <input type="radio" name="questions[{{$question['id']}}][option]" value="B">B
                    <input type="radio" name="questions[{{$question['id']}}][option]" value="C">C
                    <input type="radio" name="questions[{{$question['id']}}][option]" value="D">D
                </div>
            @endforeach
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