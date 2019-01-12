 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Program Offer</h4>
 				<a href="{{URL::to('/programoffer')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('programoffer')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					@if($roleid==1)
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="instituteid">Institute  &nbsp; </label>
 						<select onchange="getCommonChange(this,'programofferview')" name="instituteid" required="1" class="form-control" id="instituteid">
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
 						<label class="control-label" for="sessionid">Session  &nbsp; </label>
 						<select name="sessionid" required="1" class="form-control" id="sessionid">
 							<option value="">Select</option>
 							@foreach($sessionList as $aObj)
 							@if($aObj->id==$bean->sessionid)
 								<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="programid">Class  &nbsp; </label>
 						<select onchange="getCommonChange(this,'programtogroup')" name="programid" required="1" class="form-control" id="programid">
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
 						<label class="control-label" for="groupid">Group  &nbsp; </label>
 						<select name="groupid" required="1" class="form-control" id="groupid">
 							<option value="">Select</option>
 							@foreach($groupList as $aObj)
 							@if($aObj->id==$bean->groupid)
 								<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="mediumid">Medium  &nbsp; </label>
 						<select name="mediumid" required="1" class="form-control" id="mediumid">
 							<option value="">Select</option>
 							@foreach($mediumList as $aObj)
 							@if($aObj->id==$bean->mediumid)
 								<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="shiftid">Shift  &nbsp; </label>
 						<select name="shiftid" required="1" class="form-control" id="shiftid">
 							<option value="">Select</option>
 							@foreach($shiftList as $aObj)
 							@if($aObj->id==$bean->shiftid)
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