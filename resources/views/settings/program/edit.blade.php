 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Class</h4>
 				<a href="{{URL::to('/program')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('program')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="programLevelid">Class/Program Level  &nbsp; </label>
 						<select onchange="getGroupByLevel()" name="programLevelid" required="1" class="form-control" id="programLevelid">
 							@foreach($levels as $aObj)
 								@if($aObj->id==$bean->programLevelid)
 								<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 								@else
 								<option  value="{{$aObj->id}}">{{$aObj->name}}</option>
 								@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="groupid">Group  &nbsp; </label>
 						<select name="groupid" required="1" class="form-control" id="groupid">
 							@foreach($groups as $aObj)
 								@if($aObj->id==$bean->programLevelid)
 								<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 								@else
 								<option  value="{{$aObj->id}}">{{$aObj->name}}</option>
 								@endif							
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="name">Class Name :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection