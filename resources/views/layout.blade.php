<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Simple Responsive Admin</title>
	<!-- BOOTSTRAP STYLES-->
	<link href="../css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="../css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="../css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

	@yield('head-script')
</head>
<body>



<div id="wrapper">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="adjust-nav">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">
					<img src="../img/logo.png" />

				</a>
			</div>
			<span class="logout-spn" >
                  <a href="#" style="color:#fff;">LOGOUT</a>
			</span>
		</div>
	</div>
	<!-- /. NAV TOP  -->
	<nav class="navbar-default navbar-side" role="navigation">
		<div class="sidebar-collapse">
			<ul class="nav" id="main-menu">
				<li class="active-link">
					<a href="/" ><i class="fa fa-desktop "></i>Dashboard <span class="badge">Included</span></a>
				</li>
				<li>
					<a href="/topics/list"><i class="fa fa-table "></i>Topics  <span class="badge">Included</span></a>
				</li>
				<li>
					<a href="/tests/list"><i class="fa fa-table "></i>Tests  <span class="badge">Included</span></a>
				</li>
				<li>
					<a href="/questions/list"><i class="fa fa-table "></i>Questions  <span class="badge">Included</span></a>
				</li>
			</ul>
		</div>

	</nav>
	<!-- /. NAV SIDE  -->
	<div id="page-wrapper" >
		@yield('page-inner')
	</div>
	<!-- /. PAGE WRAPPER  -->
</div>
<div class="footer">


	<div class="row">
		<div class="col-lg-12" >
			&copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
		</div>
	</div>
</div>


<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="../js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="../js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="../js/custom.js"></script>
<script src="../AdminLTE/js/adminlte.min.js"></script>
{{--<script src="../js/custom.js"></script>--}}
@yield('bottom-script')
</body>
</html>
