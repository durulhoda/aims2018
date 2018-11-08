 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Employee</h4>
 				<a href="{{URL::to('/employee')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('employee')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label for="name">Name :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="employeeid">Employee ID :</label>
 						<input type="text" class="form-control" id="employeeid" name="employeeid" value="{{$bean->employeeid}}">
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="employeetypeid">Type  &nbsp; </label>
 						<select name="employeetypeid" required="1" class="form-control" id="employeetypeid">
 							<option value="">Select</option>
 							@foreach($employeetypes as $aObj)
 							@if($aObj->id==$bean->employeetypeid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection