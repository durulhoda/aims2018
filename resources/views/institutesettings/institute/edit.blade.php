 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="heading">
 				<h4>New Institue</h4>
 				<a href="{{URL::to('/institute')}}">All</a>
 				
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('institute')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row" style="margin-bottom: 10px;">
 					<div class="form-group col-xs-10 col-sm-4">
 						<label for="name">Institute Name  :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="institutetypeid">Institute Type  &nbsp; </label>
 						<select name="institutetypeid"  class="form-control" id="institutetypeid">
 							<option value="">Select</option>
 							@foreach($instituteTypes as $aObj)
 							@if($aObj->id==$bean->institutetypeid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="institutecategoryid">Institute Category  &nbsp; </label>
 						<select name="institutecategoryid"  class="form-control" id="institutecategoryid">
 							<option value="">Select</option>
 							@foreach($instituteCategory as $aObj)
 							@if($aObj->id==$bean->institutecategoryid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="institutesubcategoryid">Institute Sub Category  &nbsp; </label>
 						<select name="institutesubcategoryid"  class="form-control" id="institutesubcategoryid">
 							<option value="0">Select</option>
 							@foreach($instituteSubCategory as $aObj)
 							@if($aObj->id==$bean->institutesubcategoryid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="divisionid">Division  &nbsp; </label>
 						<select onchange="getDistbydivision()" name="divisionid"  class="form-control" id="divisionid">
 							@foreach($divisions as $aObj)
 							@if($aObj->id==$bean->divisionid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="districtid">District  &nbsp; </label>
 						<select onchange="getThanabydistrict()" name="districtid"  class="form-control" id="districtid">
 							@foreach($districts as $aObj)
 							@if($aObj->id==$bean->districtid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach 							
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="thanaid">Police Station  &nbsp; </label>
 						<select onchange="postofficeAndUnion()" name="thanaid"  class="form-control" id="thanaid">
 							@foreach($thanas as $aObj)
 							@if($aObj->id==$bean->thanaid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach 	
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="postofficeid">Post Office   &nbsp; </label>
 						<select  name="postofficeid"  class="form-control" id="postofficeid">
 							@foreach($postoffices as $aObj)
 							@if($aObj->id==$bean->postofficeid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach 							
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="localgovid">Union/Municipality &nbsp; </label>
 						<select name="localgovid" class="form-control" id="localgovid">
 							@foreach($localgovs as $aObj)
 							@if($aObj->id==$bean->localgovid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach 		
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="wordno">Word No   &nbsp; </label>
 						<input type="text" class="form-control" id="wordno" name="wordno" value="{{$bean->wordno}}">
 					</div>
 					
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="cluster">Cluster   &nbsp; </label>
 						<input type="text" class="form-control" id="cluster" name="cluster" value="{{$bean->cluster}}">
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="ein">EIIN   &nbsp; </label>
 						<input type="text" class="form-control" id="ein" name="ein" value="{{$bean->ein}}">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection