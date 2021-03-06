@extends('layouts.template')

@section('css')

<link rel="stylesheet" href="{{asset('lte/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>All Members<small></small></h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box" style="border-top : none">
					<div class="box-header with-border">
						<h3 class="box-title">Our Team</h3>
					</div>
					<div class="box-body">
						<table id="table2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Role</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($members as $member)
								<tr>
									<td>{{$member->id}}</td>
									<td><img src="{{asset('flags/'.$member->country.'.svg')}}" style="border-radius: 15%;" title="{{$member->country}}"> <a href="/profile/{{$member->id}}">{{$member->tmp_name}}</a></td>
									<td>{{$member->role}}</td>
									<td></td>
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