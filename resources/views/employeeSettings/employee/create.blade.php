 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Employee</h4>
 				<a href="{{URL::to('/employee')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('employee')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label for="name">Name  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="employeeid">Employee ID  :</label>
 						<input type="text" class="form-control" id="employeeid" name="employeeid">
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="employeetypeid">Type  &nbsp; </label>
 						<select name="employeetypeid" required="1" class="form-control" id="employeetypeid">
 							<option value="">Select</option>
 							@foreach($employeetypes as $aObj)
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>		
 							@endforeach
 						</select>
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection