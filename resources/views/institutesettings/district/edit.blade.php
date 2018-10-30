 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit District</h4>
 				<a href="{{URL::to('/district')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('district')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="divisionid">Division  &nbsp; </label>
 						<select name="divisionid" required="1" class="form-control" id="divisionid">
 							@foreach($divisions as $aObj)
 							@if($bean->divisionid==$aObj->id)
 								<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 						    @endif
 						    <option  value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="name">District Name :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection