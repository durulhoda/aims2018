 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Union</h4>
 				<a href="{{URL::to('/localgov')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('localgov')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="divisionid">Division  &nbsp; </label>
 						<select onchange="getDistbydivision()" name="divisionid" required="1" class="form-control" id="divisionid">
 							<option value="">Select</option>
 							@foreach($divisions as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="districtid">District  &nbsp; </label>
 						<select onchange="getThanabydistrict()" name="districtid" required="1" class="form-control" id="districtid">
 							<option value="">Select</option>
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="thanaid">Thana  &nbsp; </label>
 						<select name="thanaid" required="1" class="form-control" id="thanaid">
 							<option value="">Select</option>
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="name">Union :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection