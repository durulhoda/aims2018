 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Role-Menu</h4>
 				<a href="{{URL::to('/rolemenu')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('rolemenu')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="role_id">Role  &nbsp; </label>
 						<select name="role_id" required="1" class="form-control" id="role_id">
 							<option value="">Select</option>
 							@foreach($roles as $aObj)
 							@if($bean->role_id==$aObj->id)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="menu_id">Menu  &nbsp; </label>
 						<select name="menu_id" required="1" class="form-control" id="menu_id">
 							<option value="">Select</option>
 							@foreach($menus as $aObj)
 							@if($bean->menu_id==$aObj->id)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
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