@extends('layouts.template')

@section('css')
<link rel="stylesheet" href="{{asset('lte/plugins/daterangepicker/daterangepicker.css')}}">
@endsection


@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Absence Notice<small></small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box" style="border-top: none">
					<div class="box-header with-border">
						<h3 class="box-title">Book Leave</h3>
					</div>
					{!! Form::open(['url' => 'absent']) !!}
					<div class="box-body">

						<div class="form-group">
							<label for="exampleInputEmail1">Name</label>
							<input type="text" class="form-control" placeholder="{{Auth::user()->tmp_name}}" disabled>
						</div>

						<div class="form-group">
							<label>Time Period</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="date" id="reservation" required>
							</div>
							<p class="help-block">Start date - Return Date</p>
						</div>

						<div class="form-group">
							<label>Reason?</label>
							<textarea class="form-control" rows="4" name="reason" required></textarea>
						</div>

					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-danger pull-right" name="absent">Submit</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</div>
					{!! Form::close() !!}
				</div>
				@if(session('status') == 'success')
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Success!</h4>
				</div>
				@else
				@include('layouts.error')
				@endif
			</div>

			<div class="col-md-6">
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">Your absence submissions</h3>
					</div>
					<div class="box-body">
						<table id="table2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Start</th>
									<th>End</th>
									<th>Reason</th>
									
								</tr>
							</thead>
							<tbody>
								@foreach($absents as $absent)
								<tr>
									<td>{{date('F d, Y', strtotime($absent->start))}}</td>
									<td>{{date('F d, Y', strtotime($absent->end))}}</td>
									<td>
										<div class="dropdown pull-right">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Reason" style="color:#666666;"><i class="fa fa-info-circle"></i></a>
											<ul class="dropdown-menu">
												<li class="text-center">
													{{$absent->reason}}
												</li>
											</ul>
										</div>
									</td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection


@section('script')

<script>
	$(function () {
      //Initialize Select2 Elements
      $(".select2").select2();

      //Datemask dd/mm/yyyy
      $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      //Datemask2 mm/dd/yyyy
      $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
      //Money Euro
      $("[data-mask]").inputmask();

      //Date range picker
      $('#reservation').daterangepicker();
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
      //Date range as a button
      $('#daterange-btn').daterangepicker(
      {
      	ranges: {
      		'Today': [moment(), moment()],
      		'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      		'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      		'This Month': [moment().startOf('month'), moment().endOf('month')],
      		'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      	},
      	startDate: moment().subtract(29, 'days'),
      	endDate: moment()
      },
      function (start, end) {
      	$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
      );

      //Date picker
      $('#datepicker').datepicker({
      	autoclose: true
      });

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      	checkboxClass: 'icheckbox_minimal-blue',
      	radioClass: 'iradio_minimal-blue'
      });
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      	checkboxClass: 'icheckbox_minimal-red',
      	radioClass: 'iradio_minimal-red'
      });
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      	checkboxClass: 'icheckbox_flat-green',
      	radioClass: 'iradio_flat-green'
      });

      //Colorpicker
      $(".my-colorpicker1").colorpicker();
      //color picker with addon
      $(".my-colorpicker2").colorpicker();

      //Timepicker
      $(".timepicker").timepicker({
      	showInputs: false
      });
  });
</script>

@endsection