<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WebView</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="../AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../AdminLTE/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../AdminLTE/plugins/iCheck/square/blue.css">

    <link href="../css/webview/custom.css" rel="stylesheet" />

    <!-- jQuery 3 -->
    <script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    @yield('head-script')
</head>
<body>
<div>
    <div>
        @yield('page-inner')
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<div class="footer">

</div>
<!-- /. WRAPPER  -->
<!-- iCheck -->
<script src="../AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
@yield('bottom-script')
</body>
</html>
