<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FME</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
	<link rel="stylesheet" href="{{asset('lte/bootstrap/css/bootstrap.min.css')}}">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
	<link rel="stylesheet" href="{{asset('lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
	<link rel="stylesheet" href="{{asset('lte/dist/css/AdminLTE.min.css')}}">
	<link rel="stylesheet" href="{{asset('lte/dist/css/skins/_all-skins.min.css')}}">
	<link rel="stylesheet" href="{{asset('lte/bootstrap/css/font-awesome.min.css')}}">
	<!-- <link rel="stylesheet" href="{{asset('lte/plugins/daterangepicker/daterangepicker.css')}}"> -->
	<!-- <link rel="stylesheet" href="{{asset('lte/plugins/datatables/dataTables.bootstrap.css')}}"> -->
	@yield('css')
</head>
<body class="hold-transition {{Auth::user()->skin}} sidebar-mini">
	<div class="wrapper">
		@include('layouts.header')

		@include('layouts.nav')

		@yield('content')

		@include('layouts.footer')
	</div>

	<!-- jQuery 2.2.3 -->
	<script src="{{asset('lte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{asset('lte/bootstrap/js/bootstrap.min.js')}}"></script>
	<!-- Select2 -->
	<script src="{{asset('lte/plugins/select2/select2.full.min.js')}}"></script>
	<!-- InputMask -->
	<script src="{{asset('lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{asset('lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{asset('lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="{{asset('lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
	<!-- bootstrap datepicker -->
	<script src="{{asset('lte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
	<!-- bootstrap color picker -->
	<script src="{{asset('lte/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
	<!-- bootstrap time picker -->
	<script src="{{asset('lte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="{{asset('lte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
	<!-- iCheck 1.0.1 -->
	<script src="{{asset('lte/plugins/iCheck/icheck.min.js')}}"></script>
	<!-- FastClick -->
	<script src="{{asset('lte/plugins/fastclick/fastclick.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('lte/dist/js/app.min.js')}}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{asset('lte/dist/js/demo.js')}}"></script>
	@yield('script')

</body>
</html>