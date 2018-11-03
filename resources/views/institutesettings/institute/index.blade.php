@extends('layouts.main')
@section('content')
<section class="wrapper">
	<!--overview start-->
	<div class="row">
		<div class="col-lg-12">
			<div class="">
				<h4>All Institutes</h4>
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
							<th>Name</th>
							<th>Institute Type</th>
							<th>Institute Category</th>
							<th>Sub Category</th>
							<th>Police Station</th>
							<th>Post office</th>
							<th>Union/Municipality</th>
							<th>Word no</th>
							<th>Cluster</th>
							<th>EIN</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="datalist">
						@foreach($result as $aObj)
						<tr>
							<td>{{$aObj->id}}</td>
							<td>{{$aObj->name}}</td>
							<td>{{$aObj->typeName}}</td>
							<td>{{$aObj->categoryName}}</td>
							<td>{{$aObj->subcatName}}</td>
							<td>{{$aObj->thanaName}}</td>
							<td>{{$aObj->postofficeName}}</td>
							<td>{{$aObj->localgovsName}}</td>
							<td>{{$aObj->wordno}}</td>
							<td>{{$aObj->cluster}}</td>
							<td>{{$aObj->ein}}</td>
							<td> 
								<a href="{{URL::to('/institute')}}/{{$aObj->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
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