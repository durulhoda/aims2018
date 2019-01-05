 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Add New Group</h4>
 				<a href="{{URL::to('/group')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('group')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label for="name">Group Name  :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 				</div>
 				<button type="Update" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection