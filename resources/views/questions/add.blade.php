@extends('layout')

@section('page-inner')
    <div id="page-inner">
        <div class="row">
            <div class="title-page col-lg-12">
                @yield('title')
            </div>
        </div>
        <div class="row">
            <div class="box box-primary col-lg-12">
                @yield('content')
            </div>
        </div>
    </div>
@endsection

@section('bottom-script')
    <link rel="stylesheet" href="../AdminLTE/css/AdminLTE.min.css">
@endsection