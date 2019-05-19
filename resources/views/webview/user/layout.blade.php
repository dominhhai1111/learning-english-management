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
        @if (!empty($user))
            <!-- Top Navigation Menu -->
            <div class="topnav">
            <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            <span class="active user-info text-right">
                User name:
                @if (!empty($user['name']))
                    {{$user['name']}}
                @endif
            </span>
            <!-- Navigation links (hidden by default) -->
            <div id="myLinks">
                <a href="/user/info?remember_token={{$user['remember_token']}}">User Info</a>
                <a href="/user/list-topics?remember_token={{$user['remember_token']}}">Test List</a>
                <a href="/user/contact?remember_token={{$user['remember_token']}}">Contact us</a>
            </div>
        </div>
        @endif
        @yield('page-inner')
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<div class="footer">

</div>
<!-- /. WRAPPER  -->
<!-- iCheck -->
<script src="../AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="../js/webview/test.js"></script>
<script>
    var user = <?php echo !empty($user) ? json_encode($user) : '' ?>;
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    /* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
    function myFunction() {
        var x = document.getElementById("myLinks");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>
@yield('bottom-script')
</body>
</html>
