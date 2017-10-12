@extends('layouts.template')

@section('css')

<link rel="stylesheet" href="{{asset('lte/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Contact<small></small></h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">Contact</h3>
					</div>
					<div class="box-body">
						<table id="table2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Status</th>
									<th>Time</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($contacts as $contact)
								<tr>
									<td>{{$contact->serial}}</td>
									<td>{{$contact->name}}</td>
									<td>
										@if($contact->serial == $id)
										<span class="label label-primary">Now Viewing</span>
										@elseif($contact->status)
										<span class="label label-success">Seen</span>
										@else
										<span class="label label-warning">Unread</span>
										@endif
									</td>
									<td>{{$contact->created_at->format('F j, Y H:i')}} GMT</td>
									<td>
										{!! Form::open(['url' => '/contact']) !!}
										<input type="hidden" name="id" value="{{$contact->serial}}">
										<input type="hidden" name="url" value="{{$_SERVER['REQUEST_URI']}}">
										<a href="/contact/{{$contact->serial}}" title="Open">
											<span class="label label-primary"><i class="fa fa-envelope-open-o"></i></span>
										</a>
										@if($contact->status)
										<button class="btn btn-xs btn-warning" type="submit" name="action" value="unread" title="Mark as Unread"><i class="fa fa-low-vision"></i></button>
										@else
										<button class="btn btn-xs btn-success" type="submit" name="action" value="read" title="Mark as Read"><i class="fa fa-check"></i></button>
										@endif
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			@if($id)
			<div class="col-md-6">
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">Contact</h3>
					</div>
					<div class="box-body">
						<dl class="dl-horizontal">
							<dt>
								<div align="left">#</div>
							</dt>
							<dd>{{$message->serial}}</dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>
								<div align="left">Name</div>
							</dt>
							<dd>{{$message->name}}</dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>
								<div align="left">Email</div>
							</dt>
							<dd>{{$message->email}}</dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>
								<div align="left">Message</div>
							</dt>
							<dd>{{$message->message}}</dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>
								<div align="left">Time</div>
							</dt>
							<dd>{{$message->created_at->format('F j, Y H:i')}} GMT</dd>
						</dl>
					</div>
				</div>
			</div>
			@endif
		</div>
	</section>
</div>

@endsection

@section('script')

<script src="{{asset('lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('lte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
	$(function () {
		$("#table1").DataTable();
		$("#table2,#table3").DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": true
		});
	});
</script>

@endsection