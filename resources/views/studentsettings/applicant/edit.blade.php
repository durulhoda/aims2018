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
 						<label for="classId">Class ID  :</label>
 						<input type="text" class="form-control" id="classId" name="classId" value="{{$bean->classId}}">
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="programName">Class Name :</label>
 						<input type="text" class="form-control" id="programName" name="programName" value="{{$bean->programName}}">
 					</div>
 					<div class="col-xs-10 col-sm-3">
 						<label class="control-label" for="programLevelid">Class/Program Level  &nbsp; </label>
 						<select name="programLevelid" required="1" class="form-control" id="programLevelid">
 							@foreach($allLevel as $aObj)
 								@if($aObj->id==$bean->programLevelid)
 								<option selected value="{{$aObj->id}}">{{$aObj->programLevel}}</option>
 								@else
 								<option  value="{{$aObj->id}}">{{$aObj->programLevel}}</option>
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