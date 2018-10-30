 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Course Offer</h4>
 				<a href="{{URL::to('/courseoffer')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	@foreach($course as $aCourse)
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('courseoffer')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="col-xs-10 col-sm-3">
 						<label class="control-label" for="subjectcodeid">Subject &nbsp; </label>
 						<select onchange="getCourse();" name="subjectcodeid" required="1" class="form-control" id="subjectcodeid">
 							@foreach($result as $aObj)
 							@if($aObj->codeid==$bean->subjectcodeid)
 							<option selected="" value="{{$aObj->codeid}}">{{$aObj->courseName}}</option>
 							@else
 							<option value="{{$aObj->codeid}}">{{$aObj->courseName}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="subject">Subject Code :</label>
 						@foreach($result as $aObj)
 						@if($aObj->codeid==$bean->subjectcodeid)
 						<h4 style="background: #fff;margin: 0;padding: 7px;" id="subjectcode">{{$aObj->codeName}}</h4>
 						@endif
 						@endforeach
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="marks">Marks :</label>
 						<input type="text" class="form-control" id="name" name="marks" value="{{$aCourse->marks}}">
 					</div>
 				</div>
 				<button type="Update" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 	@endforeach
 </section>
 @endsection