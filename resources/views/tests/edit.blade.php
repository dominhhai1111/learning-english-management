@extends('layout')

@section('page-inner')
    <div id="page-inner">
        <div class="row">
            <div class="title-page col-lg-12">
                <h2>Edit topic</h2>
            </div>
        </div>
        <div class="row">
            <div class="box box-primary col-lg-12">
                <!-- form start -->
                <form role="form" method="post" action="" enctype="multipart/form-data">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="key">Key</label>
                            <input type="text" name="key" class="form-control" id="key" placeholder="Enter key"
                            value="@if(!empty($topic['key'])){{$topic['key']}}@endif">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name"
                                   value="@if(!empty($topic['name'])){{$topic['name']}}@endif">
                        </div>
                        <div class="form-group">
                            <label for="image_link">Image input</label>
                            <input type="file" name="image" id="inputImage">
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
@endsection