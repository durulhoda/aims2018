@extends('layouts.main')
@section('content')
<section class="wrapper">
	<!--overview start-->
	<div class="row">
		<div class="col-lg-12">
			<div class="">
				<h4>All Role</h4>
				@if($permission[2]==1)
					<a href="{{URL::to('/role')}}/{{'create'}}">New</a>
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
							<th><span style="margin-right: 25px;">Role Created By</span><label class="radio-inline"><input type="radio" name="creator" checked value="1" onchange="go(this)">Own</label>
<label class="radio-inline"><input type="radio" name="creator" value="2" onchange="go(this)">Successor</label></th>
							<th>Role Creator</th>
							<th>Institute</th>
							@if($permission[4]==1)
							<th width="10px">Edit</th>
							@endif
							@if($permission[8]==1)
							<th width="10px">Del</th>
							@endif
						</tr>
					</thead>
					 <tbody id="datalist">
						@foreach($result as $aObj)
						<tr>
							<td>{{$aObj->id}}</td>
							<td>{{$aObj->name}}</td>
							<td>{{$aObj->rolecreatorid}}</td>
							<td>{{$aObj->instituteid}}</td>
							@if($permission[4]==1)
							<td> 
								<a href="{{URL::to('/role')}}/{{$aObj->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							</td>
							@endif
							@if($permission[8]==1)
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