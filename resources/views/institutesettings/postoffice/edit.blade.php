 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Postoffice</h4>
 				<a href="{{URL::to('/postoffice')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('postoffice')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="divisionid">Division  &nbsp; </label>
 						<select onchange="getDistbydivision()" name="divisionid" required="1" class="form-control" id="divisionid">
 							<option value="">Select</option>
 							@foreach($divisions as $aObj)
 							@if($aObj->id==$bean->divisionid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="districtid">District  &nbsp; </label>
 						<select onchange="getThanabydistrict()" name="districtid" required="1" class="form-control" id="districtid">
 							@foreach($districts as $aObj)
 							@if($aObj->id==$bean->districtid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="thanaid">Thana  &nbsp; </label>
 						<select name="thanaid" required="1" class="form-control" id="thanaid">
 							@foreach($thanas as $aObj)
 							@if($aObj->id==$bean->thanaid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="name">Post office :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection