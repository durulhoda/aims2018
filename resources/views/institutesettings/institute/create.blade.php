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
 			<form action="{{URL::to('institute')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row" style="margin-bottom: 10px;">
 					<div class="form-group col-xs-10 col-sm-4">
 						<label for="name">Institute Name  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="institutetypeid">Institute Type  &nbsp; </label>
 						<select name="institutetypeid"  class="form-control" id="institutetypeid">
 							<option value="">Select</option>
 							@foreach($instituteTypes as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="institutecategoryid">Institute Category  &nbsp; </label>
 						<select name="institutecategoryid"  class="form-control" id="institutecategoryid">
 							<option value="">Select</option>
 							@foreach($instituteCategory as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="institutesubcategoryid">Institute Sub Category  &nbsp; </label>
 						<select name="institutesubcategoryid"  class="form-control" id="institutesubcategoryid">
 							<option value="0">Select</option>
 							@foreach($instituteSubCategory as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="divisionid">Division  &nbsp; </label>
 						<select onchange="getDistbydivision()" name="divisionid"  class="form-control" id="divisionid">
 							<option value="">Select</option>
 							@foreach($divisions as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="districtid">District  &nbsp; </label>
 						<select onchange="getThanabydistrict()" name="districtid"  class="form-control" id="districtid">
 							<option value="">Select</option>
 							
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="thanaid">Police Station  &nbsp; </label>
 						<select onchange="postofficeAndUnion()" name="thanaid"  class="form-control" id="thanaid">
 							<option value="">Select</option>
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="postofficeid">Post Office   &nbsp; </label>
 						<select  name="postofficeid"  class="form-control" id="postofficeid">
 							<option value="">Select</option>
 							
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="localgovid">Union/Municipality &nbsp; </label>
 						<select name="localgovid" class="form-control" id="localgovid">
 							<option value="">Select</option>			
 						</select>
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="wordno">Word No   &nbsp; </label>
 						<input type="text" class="form-control" id="wordno" name="wordno">
 					</div>
 					
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="cluster">Cluster   &nbsp; </label>
 						<input type="text" class="form-control" id="cluster" name="cluster">
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="ein">EIIN   &nbsp; </label>
 						<input type="text" class="form-control" id="ein" name="ein">
 					</div>
 					<!-- <div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="cluster">School Code   &nbsp; </label>
 						<input type="text" class="form-control" id="cluster" name="cluster">
 					</div>
 					<div class="form-group col-xs-10 col-sm-4">
 						<label class="control-label" for="cluster">College Code   &nbsp; </label>
 						<input type="text" class="form-control" id="cluster" name="cluster">
 					</div> -->
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection