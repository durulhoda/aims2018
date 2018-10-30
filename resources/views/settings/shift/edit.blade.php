 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Group</h4>
 				<a href="{{URL::to('/shift')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('shift')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label for="name">Shift Name :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="timepicker1">Start Time  :</label>
 						<input type="text" class="form-control" id="timepicker1" name="startTime" value="{{$bean->startTime}}">
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="timepicker2">End Time  :</label>
 						<input type="text" class="form-control" id="timepicker2" name="endTime" value="{{$bean->endTime}}">
 					</div> 					
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection