 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Menu</h4>
 				<a href="{{URL::to('/menu')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('menu')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label for="name">Name  :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="parentid">Parent  &nbsp; </label>
 						<select name="parentid" required="1" class="form-control" id="parentid">
 							<option value="0">No Parent</option>
 							@foreach($parents as $aObj)
 							@if($aObj->id==$bean->parentid)
 							<option selected value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option  value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 				</div>
 				<button type="Update" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection