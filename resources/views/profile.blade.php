@extends('layouts.template')

@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Profile<small></small></h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<div class="box" style="border-top : none">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="{{$profile->avatar}}">
						<h5 class="profile-username text-center">{{$profile->tmp_name}}</h5>
						<p class="text-muted text-center">
							{{DB::table('roles')->where('rank', $profile->rank)->value('role')}}
							@if($profile->tmp_iga)
							 (TMP Staff)
							@endif
						</p>
						<div class="text-center">
							<a href="https://steamcommunity.com/profiles/{{$profile->steam_id}}" target="_blank" style="color:#666666"><i class="fa fa-steam"></i></a>&emsp;
							<a href="https://truckersmp.com/user/{{$profile->tmp_id}}" target="_blank" style="color:#666666"><i class="fa fa-truck"></i></a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection