@extends('webview/user/layout')

@section('page-inner')
<style>
    .is-danger {
        color: red;
    }
</style>
<div class="hold-transition register-page">
    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
    <form action="" method="post">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="name" placeholder="Full name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <p class="help is-danger">{{ $errors->first('email') }}</p>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <p class="help is-danger">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="re-password" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            <p class="help is-danger">{{ $errors->first('re-password') }}</p>
        </div>
        <div class="row">
            <div class="col-xs-push-4 col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
        <div class="row text-center" style="padding-top: 10px">
            <div><a href="#" class="btnBackToLogin">Back to login screen</a></div>
        </div>
    </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.btnBackToLogin').on('click', function() {
            var data = JSON.stringify({"backToLogin": true});
            console.log(data);
            window.postMessage(data);
        });
    });
</script>
@endsection