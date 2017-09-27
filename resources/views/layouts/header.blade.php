<header class="main-header">
	<a href="#" class="logo">
		<span class="logo-mini"><b>FME</b></span>
		<span class="logo-lg"><b>FleetMaster Events</b></span>
	</a>
	<nav class="navbar navbar-static-top">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{Auth::user()->avatar}}" class="user-image" alt="User Image">
						<span class="hidden-xs">My Account</span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
							<p>{{Auth::user()->tmp_name}} - {{DB::table('roles')->where('rank',Auth::user()->rank)->value('role')}}
								<small>Member since {{Auth::user()->created_at->toDateTimeString()}}</small>
							</p>
						</li>
						<li class="user-footer">
							<div class="pull-left">
								<a href="/profile"
								class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="/logout" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
				<li>
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
				</li>
			</ul>
		</div>
	</nav>
</header>