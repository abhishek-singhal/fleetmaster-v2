@extends('layouts.template')

@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.datetimepicker.min.css')}}">

@endsection

@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Enter Details<small></small></h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box" style="border-top: none">
					<div class="box-header with-border">
						<h3 class="box-title">Create Event</h3>
					</div>
					{!! Form::open(['url' => 'event/create']) !!}
					<div class="box-body">
						<div class="col-md-5">

							<div class="form-group">
								<label for="exampleInputEmail1">Event Name*</label>

								<input type="text" class="form-control" placeholder="Enter Event Name" name="event_name" required>
							</div>

							<div class="form-group">
								<label>Server*</label>
								<select class="form-control" name="server">
									<option value="ETS2 EU1">ETS2 EU1</option>
									<option value="ETS2 EU2">ETS2 EU2</option>
									<option value="ETS2 EU3">ETS2 EU3</option>
									<option value="ATS EU2">ATS EU2</option>
									<option value="ATS US1">ATS US1</option>
								</select>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Source*</label>
								<input type="text" class="form-control" placeholder="Enter Starting Location" name="source" required>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Destination*</label>
								<input type="text" class="form-control" placeholder="Enter Ending Location" name="destination" required>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">SpreadSheet Link</label>
								<input type="text" class="form-control" placeholder="Enter URL" name="sheet">
								<p>Can be filled later.</p>
							</div>

						</div>
						<div class="col-md-5">
							
							<div class="form-group">
								<label>Event Time*</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input type="text" class="form-control" name="time" id="datetimepicker" required>
								</div>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Route Map</label>
								<input type="text" class="form-control" placeholder="Enter the URL of Image" name="route" required>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">ETS2C.com Page</label>
								<input type="text" class="form-control" placeholder="Enter the URL here" name="ets2c">
							</div>

							<div class="form-group">
								<label>Additional Notes:</label>
								<textarea class="form-control" rows="4" name="notes" placeholder="DLC required? or any additional information you want to provide"></textarea>
							</div>

						</div>
						<div class="col-md-2">

							<div class="form-group">
								<label>Trailer Required?</label>
								<div class="input-group">
									<label><input type="checkbox" name="trailer" class="minimal" checked></label>
								</div>
							</div>

							<div class="form-group">
								<label>Roles Needed?</label>
								<div class="input-group">
									@foreach($roles as $role)
										<input type="checkbox" class="minimal" name="role{{$role->id}}"> {{$role->name}}<br>
									@endforeach
								</div>
							</div>
						</div>

					</div>
					<div class="box-footer" align="center">
						<button type="submit" class="btn btn-primary" name="create">Create Event</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</section>
</div>

@endsection

@section('script')

<!-- <script src="js/jquery.js"></script> -->
<script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
<script>/*
   window.onerror = function(errorMsg) {
   $('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({
	value: '<?php echo date('Y/m/d H:i', time());?>',
	format: $("#datetimepicker_format_value").val()
});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function (e) {
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function (e) {
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
	dayOfWeekStart: 1,
	lang: 'en',
	disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
	startDate: '<?php echo date('Y/m/d', time())?>'
});
$('#datetimepicker').datetimepicker({value: '{{date('Y/m/d 0:0', time())}}', step: 10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime: 'H:i',
	formatDate: 'd.m.Y',
    //defaultDate:'8.12.1986', // it's my birthday
    defaultDate: '+01.01.2017', // it's my birthday
    defaultTime: '10:00',
    timepickerScrollbar: false
});

$('#datetimepicker10').datetimepicker({
	step: 5,
	inline: true
});
$('#datetimepicker_mask').datetimepicker({
	mask: '9999/19/39 29:59'
});

$('#datetimepicker1').datetimepicker({
	datepicker: false,
	format: 'H:i',
	step: 5
});
$('#datetimepicker2').datetimepicker({
	yearOffset: 222,
	lang: 'ch',
	timepicker: false,
	format: 'd/m/Y',
	formatDate: 'Y/m/d',
    minDate: '-1970/01/02', // yesterday is minimum date
    maxDate: '+1970/01/02' // and tommorow is maximum date calendar
});
$('#datetimepicker3').datetimepicker({
	inline: true
});
$('#datetimepicker4').datetimepicker();
$('#open').click(function () {
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function () {
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function () {
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker({
	datepicker: false,
	allowTimes: ['12:00', '13:00', '15:00', '17:00', '17:05', '17:20', '19:00', '20:00'],
	step: 5
});
$('#datetimepicker6').datetimepicker();
$('#destroy').click(function () {
	if ($('#datetimepicker6').data('xdsoft_datetimepicker')) {
		$('#datetimepicker6').datetimepicker('destroy');
		this.value = 'create';
	} else {
		$('#datetimepicker6').datetimepicker();
		this.value = 'destroy';
	}
});
var logic = function (currentDateTime) {
	if (currentDateTime && currentDateTime.getDay() == 6) {
		this.setOptions({
			minTime: '11:00'
		});
	} else
	this.setOptions({
		minTime: '8:00'
	});
};
$('#datetimepicker7').datetimepicker({
	onChangeDateTime: logic,
	onShow: logic
});
$('#datetimepicker8').datetimepicker({
	onGenerate: function (ct) {
		$(this).find('.xdsoft_date')
		.toggleClass('xdsoft_disabled');
	},
	minDate: '-1970/01/2',
	maxDate: '+1970/01/2',
	timepicker: false
});
$('#datetimepicker9').datetimepicker({
	onGenerate: function (ct) {
		$(this).find('.xdsoft_date.xdsoft_weekend')
		.addClass('xdsoft_disabled');
	},
	weekends: ['01.01.2014', '02.01.2014', '03.01.2014', '04.01.2014', '05.01.2014', '06.01.2014'],
	timepicker: false
});
var dateToDisable = new Date();
dateToDisable.setDate(dateToDisable.getDate() + 2);
$('#datetimepicker11').datetimepicker({
	beforeShowDay: function (date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [false, ""]
		}

		return [true, ""];
	}
});
$('#datetimepicker12').datetimepicker({
	beforeShowDay: function (date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [true, "custom-date-style"];
		}

		return [true, ""];
	}
});
$('#datetimepicker_dark').datetimepicker({theme: 'dark'})


</script>

@endsection