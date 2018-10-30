 @extends('layouts.main')
 @section('content')
 <section class="wrapper applicant">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Applicant</h4>
 				<a href="{{URL::to('/applicant')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('applicant')}}" method="POST">
 				{{csrf_field()}}
 				<fieldset class="scheduler-border">
 					<legend class="scheduler-border">Apply For</legend>
 					<div class="row">
 						<div class="col-xs-10 col-sm-3">
 							<label class="control-label" for="sessionid">Session  &nbsp;: </label>
 							<select name="sessionid" required="1" class="form-control" id="sessionid">
 								<option value="">Select</option>
 								@foreach($allLevel as $aObj)
 								<option value="1">{{$aObj->programLevel}}</option>
 								@endforeach
 							</select>
 						</div>
 						<div class="col-xs-10 col-sm-3">
 							<label class="control-label" for="programLevelid">Class Level  &nbsp;: </label>
 							<select name="programLevelid" required="1" class="form-control" id="programLevelid">
 								<option value="">Select</option>
 								@foreach($allLevel as $aObj)
 								<option value="1">{{$aObj->programLevel}}</option>
 								@endforeach
 							</select>
 						</div>
 						<div class="col-xs-10 col-sm-3">
 							<label class="control-label" for="programid">Class  &nbsp;: </label>
 							<select name="programid" required="1" class="form-control" id="programid">
 								<option value="">Select</option>
 								@foreach($allLevel as $aObj)
 								<option value="1">{{$aObj->programLevel}}</option>
 								@endforeach
 							</select>
 						</div>
 						<div class="col-xs-10 col-sm-3">
 							<label class="control-label" for="mediumid">Medium  &nbsp;: </label>
 							<select name="mediumid" required="1" class="form-control" id="mediumid">
 								<option value="">Select</option>
 								@foreach($allLevel as $aObj)
 								<option value="1">{{$aObj->programLevel}}</option>
 								@endforeach
 							</select>
 						</div>
 						<div class="col-xs-10 col-sm-3">
 							<label class="control-label" for="shiftid">Shift   &nbsp;: </label>
 							<select name="shiftid" required="1" class="form-control" id="shiftid">
 								<option value="">Select</option>
 								@foreach($allLevel as $aObj)
 								<option value="1">{{$aObj->programLevel}}</option>
 								@endforeach
 							</select>
 						</div>
 						<div class="col-xs-10 col-sm-3">
 							<label class="control-label" for="groupid">Group  &nbsp;: </label>
 							<select name="groupid" required="1" class="form-control" id="groupid">
 								<option value="">Select</option>
 								@foreach($allLevel as $aObj)
 								<option value="1">{{$aObj->programLevel}}</option>
 								@endforeach
 							</select>
 						</div>
 					</div>
 				</fieldset>
 				<button type="submit" class="btn btn-default">Apply</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection