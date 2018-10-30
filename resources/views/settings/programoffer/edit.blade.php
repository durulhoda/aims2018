 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="heading">
 				<h4>Edit Program Offer</h4>
 				<a href="{{URL::to('/programoffer')}}">All</a>
 				@if (session('msg'))
 				<div class="msg">
 					{{ session('msg') }}
 				</div>
 				@endif
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('programoffer')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row" style="margin-bottom: 10px;">
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="sessionid">Session  &nbsp; </label>
 						<select name="sessionid"  class="form-control" id="sessionid">
 							@foreach($sessions as $aObj)
 							@if($aObj->id==$bean->sessionid)
 							<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option  value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="programLevelid">Class/Program Level  &nbsp; </label>
 						<select onchange="cascadeAction()" name="programLevelid"  class="form-control" id="programLevelid">
 							@foreach($levels as $aObj)
 							@if($aObj->id==$bean->programLevelid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="groupid">Group  &nbsp; </label>
 						<select onchange="getPrograms()" name="groupid" class="form-control" id="groupid">
 							@foreach($groups as $aObj)
 							@if($aObj->id==$bean->groupid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="programid">Class  &nbsp; </label>
 						<select name="programid"  class="form-control" id="programid">
 							@foreach($programs as $aObj)
 							@if($aObj->id==$bean->programid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="mediumid">Medium   &nbsp; </label>
 						<select name="mediumid"  class="form-control" id="mediumid">
 							@foreach($mediums as $aObj)
 							@if($aObj->id==$bean->mediumid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="shiftid">Shift  &nbsp; </label>
 						<select name="shiftid"  class="form-control" id="shiftid">
 							@foreach($shifts as $aObj)
 							@if($aObj->id==$bean->shiftid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>

 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="applicantSeat">Total Seat   &nbsp; </label>
 						<input type="text" class="form-control" id="applicantSeat" name="applicantSeat" value="{{$bean->applicantSeat}}">
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="quota">Quata   &nbsp; </label>
 						<input type="text" class="form-control" id="quota" name="quota" value="{{$bean->quota}}">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection