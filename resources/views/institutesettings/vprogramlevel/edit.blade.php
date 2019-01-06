@extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Program Level Assign</h4>
 				<a href="{{URL::to('/vprogramlevels')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('vprogramlevels')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					@if($roleid==1)
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="instituteid">Institute  &nbsp; </label>
 						<select name="instituteid" required="1" class="form-control" id="instituteid">
 							<option value="">Select</option>
 							@foreach($instituteList as $aObj)
 							@if($aObj->id==$bean->instituteid)
 								<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					@else
 					<input type="hidden" value="{{$aInstitute->id}}" name="instituteid">
 					@endif
 				
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="programid">Class  &nbsp; </label>
 						<select name="programid" required="1" class="form-control" id="programid">
 							<option value="">Select</option>
 							@foreach($programList as $aObj)
 							@if($aObj->id==$bean->programid)
 								<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="programlevelid">Program Level  &nbsp; </label>
 						<select name="programlevelid" required="1" class="form-control" id="programlevelid">
 							<option value="">Select</option>
 							@foreach($levelList as $aObj)
 							@if($aObj->id==$bean->programlevelid)
 								<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
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