 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Session</h4>
 				<a href="{{URL::to('/session')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('session')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					@if($roleid==1)
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="instituteid">Institute  &nbsp; </label>
 						<select name="instituteid" required="1" class="form-control" id="instituteid">
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
 					<div class="form-group col-sm-4">
 						<label for="name">Session :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div> 				
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection