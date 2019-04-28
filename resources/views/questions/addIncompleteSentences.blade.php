@extends('questions.add')

@section('title')
<h2>Add</h2>
@endsection


@section('content')
<!-- form start -->
<form role="form" method="post" action="" enctype="multipart/form-data">
    @csrf <!-- {{ csrf_field() }} -->
    <input type="hidden" name="questionType" value="{{INCOMPLETE_SENTENCES}}">
    <div class="box-body">
        <div class="form-group">
            <label for="name">Topic</label>
            <input type="text" name="topic" class="form-control" value="Incomplete Sentences" readonly>
        </div>
        <div class="form-group">
            <label for="name">Description</label>
            <input type="text" name="description" class="form-control" placeholder="Enter description">
        </div>
        <div class="form-group">
            <label for="name">Difficulty</label>
            <select name="level" class="form-control">
                <option value="1">Easy</option>
                <option value="2">Normal</option>
                <option value="3">Hard</option>
            </select>
        </div>
        <div class="form-group">
            <p style="font-weight: bold">Question</p>
            <textarea name="question" id="" cols="30" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <p style="font-weight: bold">Options</p>
            <p>
                <input type="radio" value="A" name="correct_answer" class="form-input">
                <label for="A">A: </label>
                <input type="text" name="answers[A]" class="form-input"/>
            </p>
            <p>
                <input type="radio" value="B" name="correct_answer" class="form-input">
                <label for="B">B: </label>
                <input type="text" name="answers[B]" class="form-input"/>
            </p>
            <p>
                <input type="radio" value="C" name="correct_answer" class="form-input">
                <label for="C">C: </label>
                <input type="text" name="answers[C]" class="form-input"/>
            </p>
            <p>
                <input type="radio" value="D" name="correct_answer" class="form-input">
                <label for="D">D: </label>
                <input type="text" name="answers[D]" class="form-input">
            </p>
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
@endsection