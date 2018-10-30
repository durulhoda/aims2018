@extends('layouts.main')
@section('content')
<section class="wrapper">
	<!--overview start-->
	<div class="row">
		<div class="col-lg-12">
			<div class="">
				<h4>All Class Information</h4>
				<a href="{{URL::to('/program')}}/{{'create'}}">New</a>
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
							<th width="15">Sl No.</th>
							<th width="20%">Class/Program Level</th>
							<th width="20%">Group</th>
							<th width="30%">Class/Program</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					 <tbody id="datalist">
					 	<?php $id=0; ?>
						@foreach($result as $aObj)
						<tr>
							<td>{{++$id}}</td>
							<td>{{$aObj->lavelName}}</td>
							<td>{{$aObj->groupName}}</td>
							<td>{{$aObj->name}}</td>
							<td> 
								<a href="{{URL::to('/program')}}/{{$aObj->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
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