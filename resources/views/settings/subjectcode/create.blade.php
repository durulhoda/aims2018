 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Add Subject Code</h4>
 				<a href="{{URL::to('/subjectcode')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('subjectcode')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="programLevelid">Class/Program Level  &nbsp; </label>
 						<select onchange="cascadeAction()" name="programLevelid"  class="form-control" id="programLevelid">
 							<option value="">Select</option>
 							@foreach($levels as $aObj)
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="groupid">Group  &nbsp; </label>
 						<select onchange="getPrograms()" name="groupid"  class="form-control" id="groupid">
 							<option value="">Select</option>
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="programid">Class/Program  &nbsp; </label>
 						<select name="programid"  class="form-control" id="programid">
 							<option value="">Select</option>
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="courseid">Subject  &nbsp; </label>
 						<select name="courseid"  class="form-control" id="courseid">
 							<option value="">Select</option>
 							@foreach($courses as $aObj)
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="name">Subject Code  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection