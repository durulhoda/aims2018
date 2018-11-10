@extends('layouts.main')
@section('content')
<section class="wrapper">
	<!--overview start-->
	<div class="row">
		<div class="col-lg-12">
			<div class="">
				<h4>All Course offer</h4>
				@if($accessStatus[2]==1)
					<a href="{{URL::to('/courseoffer')}}/{{'create'}}">New</a>
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
							<th>Session</th>
							<th>Class</th>
							<th>Subject Code</th>
							<th>Subject</th>
							<th>Marks</th>
							@if($accessStatus[4]==1)
							<th width="10px">Edit</th>
							@endif
							@if($accessStatus[8]==1)
							<th width="10px">Del</th>
							@endif
						</tr>
					</thead>
					<tbody id="myTable">
						@foreach($result as $aObj)
						<tr>
							<td>{{$aObj->sessionName}}</td>
							<td>{{$aObj->programName}}</td>
							<td>{{$aObj->subjectCode}}</td>
							<td>{{$aObj->courseName}}</td>
							<td>{{$aObj->marks}}</td>
							@if($accessStatus[4]==1)
							<td> 
								<a href="{{URL::to('/courseoffer')}}/{{$aObj->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							</td>
							@endif
							@if($accessStatus[8]==1)
							<td>
								<a href="" class="tooltip-error" data-rel="tooltip" title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection