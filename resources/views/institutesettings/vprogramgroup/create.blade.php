 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Group Assign</h4>
 				<a href="{{URL::to('/vprogramgroup')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('vprogramgroup')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					@if($roleid==1)
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="instituteid">Institute  &nbsp; </label>
 						<select onchange="getCommonChange(this,'programgroup')" name="instituteid" required="1" class="form-control" id="instituteid">
 							<option value="">Select</option>
 							@foreach($instituteList as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					@else
 					<input type="hidden" value="{{$aInstitute->id}}" name="instituteid">
 					@endif
 					<div class="col-xs-10 col-sm-4" id="output1">
 						<label class="control-label" for="programid">Class  &nbsp; </label>
 						<select name="programid" required="1" class="form-control" id="programid">
 							<option value="">Select</option>
 							@foreach($programList as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4" id="output2">
 						<label class="control-label" for="groupid">Group  &nbsp; </label>
 						<select name="groupid" required="1" class="form-control" id="groupid">
 							<option value="">Select</option>
 							@foreach($groupList as $aObj)
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