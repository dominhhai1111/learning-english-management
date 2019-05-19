@extends('questions.add')

@section('title')
<h2>Edit</h2>
@endsection


@section('content')
<!-- form start -->
<form role="form" method="post" action="" enctype="multipart/form-data">
    @csrf <!-- {{ csrf_field() }} -->
    <input type="hidden" name="questionType" value="{{INCOMPLETE_SENTENCES}}">
    <div class="box-body">
        <div class="form-group">
            <label for="name">Part</label>
            <input type="text" name="topic" class="form-control" value="Incomplete Sentences" readonly>
        </div>
        <div class="form-group">
            <label for="name">Description</label>
            <input type="text" name="description" class="form-control" placeholder="Enter description" value="{{$question['description']}}">
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
            <p style="font-weight: bold">Question</p>
            <textarea name="question" id="" cols="30" rows="3" class="form-control">{{$question['question']}}</textarea>
        </div>
        <div class="form-group">
            <p style="font-weight: bold">Options</p>
            <p>
                <input type="radio" value="A" name="correct_answer" class="form-input" <?php if($question['correct_answer'] == 'A') echo "checked"?>>
                <label for="A">A: </label>
                <input type="text" name="answers[A]" class="form-input" value="{{$question['answers']['A']}}">
            </p>
            <p>
                <input type="radio" value="B" name="correct_answer" class="form-input" <?php if($question['correct_answer'] == 'B') echo "checked"?>>
                <label for="B">B: </label>
                <input type="text" name="answers[B]" class="form-input" value="{{$question['answers']['B']}}">
            </p>
            <p>
                <input type="radio" value="C" name="correct_answer" class="form-input" <?php if($question['correct_answer'] == 'C') echo "checked"?>>
                <label for="C">C: </label>
                <input type="text" name="answers[C]" class="form-input" value="{{$question['answers']['C']}}">
            </p>
            <p>
                <input type="radio" value="D" name="correct_answer" class="form-input" <?php if($question['correct_answer'] == 'D') echo "checked"?>>
                <label for="D">D: </label>
                <input type="text" name="answers[D]" class="form-input" value="{{$question['answers']['D']}}">
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