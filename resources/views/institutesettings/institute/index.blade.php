@extends('layouts.main')
@section('content')
<section class="wrapper">
	<!--overview start-->
	<div class="row">
		<div class="col-lg-12">
			<div class="">
				<h4>All Subject Information</h4>
				<a href="{{URL::to('/institute')}}/{{'create'}}">New</a>
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
							<th>Subject Name</th>
							<th>Action</th>
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