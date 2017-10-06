<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{Auth::user()->steam_name}}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<ul class="sidebar-menu">
			<li class="header text-center">MAIN NAVIGATION</li>
			<li @if(Request::is('dashboard'))class="active"@endif>
				<a href="/dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					<span class="pull-right-container">
						<!--<small class="label pull-right bg-blue">1</small>-->
					</span>
				</a>
			</li>

			<li @if(Request::is('event/create'))class="active"@endif>
				<a href="/event/create">
					<i class="fa fa-calendar-plus-o"></i> <span>Create Event</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-red"></small>
					</span>
				</a>
			</li>

			<li @if(Request::is('members'))class="active"@endif>
				<a href="/members">
					<i class="fa fa-users"></i> <span>Members</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-red"></small>
					</span>
				</a>
			</li>

			<li @if(Request::is('absent'))class="active"@endif>
				<a href="/absent">
					<i class="fa fa-child"></i> <span>Absence Notice</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-red"></small>
					</span>
				</a>
			</li>

			@if(Auth::user()->rank >= 4)
			<li class="header text-center">ADMIN CONTROLS</li>

			<li @if(Request::is('members/new'))class="active"@endif>
				<a href="/members/new">
					<i class="fa fa-user-plus"></i> <span>New Logins</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-red">{{DB::table('users')->where('rank',0)->count()}}</small>
					</span>
				</a>
			</li>

			<li @if(Request::is('members/all'))class="active"@endif>
				<a href="/members/all">
					<i class="fa fa-wrench"></i> <span>Update Ranks</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-red"></small>
					</span>
				</a>
			</li>

			<li @if(Request::is('event/new'))class="active"@endif>
				<a href="/event/new">
					<i class="fa fa-clone"></i> <span>New Events</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-green">{{DB::table('events')->where([['status' , 0],['time', '>=', date("Y-m-d H:i:s", time())]])->count()}}</small>
					</span>
				</a>
			</li>
			@endif
		</ul>
	</section>
</aside>