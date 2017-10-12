<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<strong><a href="/">FLEETMASTER EVENTS</a></strong>
	</div>
	<strong>Copyright &copy; 2017</strong> All rights reserved.
</footer>

<aside class="control-sidebar control-sidebar-dark">
	<!-- Create the tabs -->
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Home tab content -->
		<!--    <h4 class="control-sidebar-heading">Skins</h4>-->
		<ul class="list-unstyled clearfix">
			{!! Form::open(['url' => 'user/skin']) !!}
			<div class="form-group">
				<label>Choose Skin:</label>
				<select class="form-control select" name="skin" style="width: 60%;display:inline-block;">
					<option value="skin-blue">Blue</option>
					<option value="skin-yellow">Yellow</option>
					<option value="skin-red">Red</option>
					<option value="skin-purple">Purple</option>
					<option value="skin-green">Green</option>
					<option value="skin-black">Black</option>
					<option value="skin-blue-light">Blue Light</option>
					<option value="skin-yellow-light">Yellow Light</option>
					<option value="skin-red-light">Red Light</option>
					<option value="skin-purple-light">Purple Light</option>
					<option value="skin-green-light">Green Light</option>
					<option value="skin-black-light">Black Light</option>
				</select>
				<input type="hidden" name="url" value="{{$_SERVER['REQUEST_URI']}}">
				<button type="submit" class="btn btn-danger pull-right">Apply</button>
			</div>
			{!! Form::close() !!}
		</ul>
	</div>
</aside>