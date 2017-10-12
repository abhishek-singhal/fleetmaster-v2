@extends('layouts.template')

@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>New Events<small></small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">New Events need approval</h3>
					</div>
					<div class="box-body">
						<table id="table2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Creator</th>
									<th>Event Name</th>
									<th>Server</th>
									<th>Source</th>
									<th>Destination</th>
									<th>Trailer</th>
									<th>Time</th>
									<th>Route</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($events as $event)
								<tr>
									<td>{{$event->id}}</td>
									<td><a href="/profile/{{$event->user_id}}">{{DB::table('users')->where('id', $event->user_id)->value('tmp_name')}}</a></td>
									<td><a href="/event/{{$event->id}}">{{$event->name}}</a></td>
									<td>{{$event->server}}</td>
									<td>{{$event->source}}</td>
									<td>{{$event->destination}}</td>
									<td>
										@if($event->trailer)
											Yes
										@else
											No
										@endif
									</td>
									<td>{{date("F j, Y H:i", strtotime($event->time))}} GMT</td>
									<td>
										<a href="{{$event->route}}" target="_blank">
											<i class="fa fa-external-link"></i>
										</a>
									</td>
									<td>
										{!! Form::open(['url' => '/event/new']) !!}
										<input type="hidden" name="event_id" value="{{$event->id}}">
										<button type="submit" name="action" value="approve" class="btn btn-xs btn-success">Approve</button>
										<a href="/event/{{$event->id}}/edit"><span class="btn btn-xs btn-info">Edit</span></a>
										<button type="submit" name="action" value="delete" class="btn btn-xs btn-danger">Delete</button>
										{!! Form::close() !!}
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