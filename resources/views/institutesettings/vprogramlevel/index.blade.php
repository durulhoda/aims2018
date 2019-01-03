@extends('layouts.main')
@section('content')
<section class="wrapper">
	<!--overview start-->
	<div class="row">
		<div class="col-lg-12">
			<div class="">
				<h4>Program Level</h4>
				@if($permission[2]==1)
					<a href="{{URL::to('/vprogramlevels')}}/{{'create'}}">New</a>
				@endif
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<input class="form-control" id="myInput" type="text" placeholder="Search..">
			<div class="table-responsive bgtable">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sl No.</th>
							<th>Institute Name</th>
							<th>Session</th>
							<th>Class</th>
							<th>Program Level</th>
							@if($permission[4]==1)
							<th width="10px">Edit</th>
							@endif
							@if($permission[8]==1)
							<th width="10px">Del</th>
							@endif
						</tr>
					</thead>
					<tbody id="datalist">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection