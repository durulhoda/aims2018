 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Program Level Assign</h4>
 				<a href="{{URL::to('/vprogramlevels')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('vprogramlevels')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="divisionid">Institute  &nbsp; </label>
 						<select onchange="getDistbydivision()" name="divisionid" required="1" class="form-control" id="divisionid">
 							<option value="">Select</option>
 							
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="districtid">Session  &nbsp; </label>
 						<select onchange="getThanabydistrict()" name="districtid" required="1" class="form-control" id="districtid">
 							<option value="">Select</option>
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="thanaid">Class  &nbsp; </label>
 						<select name="thanaid" required="1" class="form-control" id="thanaid">
 							<option value="">Select</option>
 							@foreach($programList as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="thanaid">Program Level  &nbsp; </label>
 						<select name="thanaid" required="1" class="form-control" id="thanaid">
 							<option value="">Select</option>
 							@foreach($levelList as $aObj)
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