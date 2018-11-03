@extends('layouts.main')
@section('content')
<section class="wrapper">
	<!--overview start-->
	<div class="row">
		<div class="col-lg-12">
			<div class="">
				<h4>All Designation</h4>
				<a href="{{URL::to('/employeedesignation')}}/{{'create'}}">New</a>
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
							<th>Employee Designation</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="datalist">
						@foreach($result as $aObj)
						<tr>
							<td>{{$aObj->id}}</td>
							<td>{{$aObj->name}}</td>
							
								<td> 
									<a href="{{URL::to('/employeedesignation')}}/{{$aObj->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
								<a href="" class="tooltip-error" data-rel="tooltip" title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection