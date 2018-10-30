 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="heading">
 				<h4>New Program Offer</h4>
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
 			<form action="{{URL::to('programoffer')}}" method="POST" id="framework_form">
 				{{csrf_field()}}
 				<div class="row" style="margin-bottom: 10px;">
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="sessionid">Session  &nbsp; </label>
 						<select name="sessionid"  class="form-control" id="sessionid">
 							<option value="">Select</option>
 							@foreach($sessions as $aObj)
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="programLevelid">Class/Program Level  &nbsp; </label>
 						<select onchange="cascadeAction()" name="programLevelid"  class="form-control" id="programLevelid">
 							<option value="">Select</option>
 							@foreach($levels as $aObj)
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="groupid">Group  &nbsp; </label>
 						<select onchange="getPrograms()" name="groupid" class="form-control" id="groupid">
 							<option value="">Select</option>			
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="programid">Class  &nbsp; </label>
 						<select name="programid"  class="form-control" id="programid">
 							<option value="">Select</option>
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="mediumid">Medium   &nbsp; </label>

 						<select  name="mediumid"  class="form-control" id="mediumid">
 							<option value="">Select</option>
 							@foreach($mediums as $aObj)
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="shiftid">Shift  &nbsp; </label>
 						<select name="shiftid"  class="form-control" id="shiftid">
 							<option value="">Select</option>
 							@foreach($shifts as $aObj)
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="applicantSeat">Total Seat   &nbsp; </label>
 						<input type="text" class="form-control" id="applicantSeat" name="applicantSeat">
 					</div>
 					
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="quota">Quata   &nbsp; </label>
 						<input type="text" class="form-control" id="quota" name="quota">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection