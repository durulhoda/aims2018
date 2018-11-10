 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Menu</h4>
 				<a href="{{URL::to('/rolemenu')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('rolemenu')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="role_id">Role  &nbsp; </label>
 						<select name="role_id" required="1" class="form-control" id="role_id">
 							<option value="">Select</option>
 							@foreach($roles as $aObj)
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="menu_id">Menu  &nbsp; </label>
 						<select name="menu_id" required="1" class="form-control" id="menu_id">
 							<option value="">Select</option>
 							@foreach($menus as $aObj)
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