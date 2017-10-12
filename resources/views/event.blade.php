@extends('layouts.template')

@section('css')

@endsection

@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Event Details<small></small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<!-- info -->
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">
							{{$event->name}}
						</h3>
						@if(Auth::user()->rank >= 4 || $event->user_id == Auth::user()->id)
						<a href="/event/{{$event->id}}/edit">
							<button type="button" class="btn btn-info btn-xs pull-right">Edit</button>
						</a>
						@endif
					</div>

					<div class="box-body">
						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Event Name
								</div>
							</dt>
							<dd>
								{{$event->name}}
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Server
								</div>
							</dt>
							<dd>
								{{$event->server}}
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Source
								</div>
							</dt>
							<dd>
								{{$event->source}}
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Destination
								</div>
							</dt>
							<dd>
								{{$event->destination}}
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Time
								</div>
							</dt>
							<dd>
								{{date("F j, Y H:i", strtotime($event->time))}} GMT (UTC)
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Trailer
								</div>
							</dt>
							<dd>
								@if($event->trailer)
								Yes
								@else
								No
								@endif
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Route Map
								</div>
							</dt>
							<dd>
								@if(!is_null($event->route))
								<a href="{{$event->route}}" target="_blank">Click Here</a>
								@else
								Not Available
								@endif
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									ETS2C.com Page
								</div>
							</dt>
							<dd>
								@if(!is_null($event->ets2c))
								<a href="{{$event->ets2c}}" target="_blank">Click Here</a>
								@else
								Not Available
								@endif
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									SpreadSheet
								</div>
							</dt>
							<dd>
								@if(!is_null($event->sheet))
								<a href="{{$event->sheet}}" target="_blank">Click Here</a>
								@else
								Not Available
								@endif
							</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Additional Notes:
								</div>
							</dt>
							<dd>
								{{$event->notes}}
							</dd>
						</dl>						
						@if($save_file)
						<dl class="dl-horizontal">
							<dt>
								<div align="left">
									Save File:
								</div>
							</dt>
							<dd>
								<a href="{{Storage::url('saves\FleetMasterEvents-'.$event->id.'.zip')}}" download>
									<button class="btn btn-info">Download</button>
								</a>
							</dd>
						</dl>
						
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">Roles</h3>
						<div class="box-tools">
							<ul class="pagination pagination-sm no-margin pull-right">
								Created By: <a href="/profile/{{$event->user_id}}">{{DB::table('users')->where('id', $event->user_id)->value('tmp_name')}}</a>
							</ul>
						</div>
					</div>

					<div class="box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>Role</th>
								<th>Status</th>
							</tr>

							@foreach($event_roles as $event_role)
							<tr>
								<td>{{$event_role->name}}
									@if($event_role->confirm)
									<i class="fa fa-check pull-right" title="Confirmed"></i>
									@elseif(!$event_role->confirm AND $event_role->user_id)
									<i class="fa fa-times pull-right" title="Not Confirmed"></i>
									@endif
								</td>
								<td>
									@if($event_role->user_id)
									{!! Form::open(['url' => 'role/confirm']) !!}
									<img src="{{asset('flags/'.$event_role->country.'.svg')}}" style="border-radius: 15%;" title="{{$event_role->country}}"> {{$event_role->tmp_name}}

									<input type="hidden" name="role_id" value="{{$event_role->role_id}}">
									<input type="hidden" name="event_id" value="{{$event->id}}">
									<button type="submit" class="btn btn-danger btn-xs pull-right" name="action" value="delete" title="Delete"><i class="fa fa-trash-o"></i></button>
									@if($event_role->confirm)
									<button type="submit" class="btn btn-warning btn-xs pull-right" name="action" value="unconfirm" title="Unconfirm"><i class="fa fa-circle"></i></button>
									@elseif(!$event_role->confirm)
									<button type="submit" class="btn btn-success btn-xs pull-right" name="action" value="confirm" title="Confirm"><i class="fa fa-check"></i></button>
									@endif
									{!! Form::close() !!}
									@else
									<span class="label label-success">Available</span>
									@endif

								</td>
							</tr>
							@endforeach
							<tr>
								<td>Drivers</td>
								<td>
									@foreach($drivers as $driver)
									{!! Form::open(['url' => 'role/removedriver']) !!}
									<img src="{{asset('flags/'.$driver->country.'.svg')}}" style="border-radius: 15%;" title="{{$driver->country}}"> {{$driver->tmp_name}}
									<input type="hidden" name="event_id" value="{{$driver->event_id}}">
									<input type="hidden" name="user_id" value="{{$driver->user_id}}">
									<button type="submit" class="btn btn-danger btn-xs pull-right" title="Delete"><i class="fa fa-trash-o"></i></button><br>
									{!! Form::close() !!}
									@endforeach
								</td>
							</tr>
						</table>
					</div>
				</div>

			</div>
			<div class="col-md-4">
				<!-- Your Role -->
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">Your Role</h3>
						<div class="box-tools">
							<ul class="pagination pagination-sm no-margin pull-right">
								@foreach($event_roles as $event_role)
								@if($event_role->user_id == Auth::user()->id)
								{{$event_role->name}}
								@endif
								@endforeach
								@foreach($drivers as $driver)
								@if($driver->user_id == Auth::user()->id)
								Driver
								@endif
								@endforeach
							</ul>
						</div>
					</div>
					{!! Form::open(['url' => '/role/yourrole']) !!}
					<div class="box-body">
						<div class="form-group">
							<label>Choose A Role</label>
							<input type="hidden" value="{{$event->id}}" name="event_id">
							<select class="form-control select2" name="role_id">
								@foreach($event_roles as $event_role)
								<option value="{{$event_role->role_id}}" @if(!is_null($event_role->user_id)) disabled="disabled" @endif>
									{{$event_role->name}}
								</option>
								@endforeach
								<option value="driver">Driver</option>
							</select>
						</div>
						@if(session('take_status') == "success")
						Role Successfully Taken.
						@elseif(session('take_status') == "failed")
						Role Already Taken.
						@elseif(session('take_status') == 'removed')
						Role Successfully Removed.
						@endif
					</div>
					<div class="box-footer">
						@foreach($event_roles as $event_role)
						@if($event_role->user_id == Auth::user()->id)
						<button type="submit" class="btn btn-danger" name="action" value="remove_role">Remove Role</button>
						@endif
						@endforeach
						@if(!is_null(DB::table('drivers')->where([['event_id', $event->id],['user_id', Auth::user()->id]])->first()))
						<button type="submit" class="btn btn-danger" name="action" value="remove_role">Remove Role</button>
						@endif
						<button type="submit" class="btn btn-primary pull-right" name="action" value="take_role">Submit</button>
					</div>
				</div>
				{!! Form::close() !!}

				@if(Auth::user()->rank >= 4)
				<!-- give role -->
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">Give Role</h3>
						<div class="box-tools">
							<ul class="pagination pagination-sm no-margin pull-right">
								Supervisor+
							</ul>
						</div>
					</div>
					{!! Form::open(['url' => '\role\giverole']) !!}
					<div class="box-body">
						<div class="form-group">
							<input type="hidden" value="{{$event->id}}" name="event_id">
							<label>Choose A Role</label>
							<select class="form-control select2" name="role_id">
								@foreach($event_roles as $event_role)
								<option value="{{$event_role->role_id}}" @if(!is_null($event_role->user_id)) disabled="disabled" @endif>
									{{$event_role->name}}
								</option>
								@endforeach
								<option value="driver">Driver</option>
							</select>
						</div>
						<div class="form-group">
							<label>Choose A Member</label>
							<select class="form-control select2" name="user_id">
								@foreach($users = DB::table('users')->where('rank', '>=', 3)->get() as $user)
								<option value="{{$user->id}}">{{$user->tmp_name}}</option>
								@endforeach
							</select>
						</div>
						@if(session('give_status') == 'failed_user')
						User already has a different role.
						@elseif(session('give_status') == 'failed_role')
						This role is assigned to someone else.
						@elseif(session('give_status') == 'success')
						Role Assigned
						@endif
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</div>
					{!! Form::close() !!}
				</div>
				@endif

				@if(Auth::user()->rank >= 4 || $event->user_id == Auth::user()->id)
				<!-- Save file upload -->
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">Upload Save File</h3>
					</div>
					@if(!$save_file)
					{!! Form::open(['url' => '/uploadsave', 'files' => true]) !!}
					<div class="box-body">
						<input type="hidden" name="event_id" value="{{$event->id}}">
						<div class="form-group">
							<!-- <label for="exampleInputFile">File input</label> -->
							<input type="file" id="exampleInputFile" name="save" required>
							<p class="help-block">Only zip file allowed.</p>
						</div>
						@if(session('status_file') == 'failed_ext')
						File not supported.
						@elseif(session('status_file') == 'failed_exist')
						File already exists. Delete the existing file to re-upload.
						@endif
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary pull-right">Submit</button>
					</div>
					{!! Form::close() !!}
					@else
					<div class="box-body">
						<div class="form-group"><p class="help-block">File is uploaded.</p></div>
					</div>
					{!! Form::open(['url' => '/deletesave']) !!}
					<div class="box-footer">
						<input type="hidden" name="event_id" value="{{$event->id}}">
						<button type="submit" class="btn btn-danger">Delete File</button>
					</div>
					{!! Form::close() !!}
					@endif
				</div>
				@endif
				
			</div>
		</div>

	</section>
</div>

@endsection

@section('script')

@endsection