 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Role</h4>
 				<a href="{{URL::to('/role')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('role')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-3">
 						<label for="name">Role  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 					<div class="form-group col-sm-3">
 						<label class="control-label" for="rolecreatorid">Role Creator  &nbsp; </label>
 						<select onchange="createRolePower()" name="rolecreatorid" required="1" class="form-control" id="rolecreatorid">
 							@foreach($successorRole as $aObj)			
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach	
 						</select>
 					</div>
 				</div>
 				<div class="row" id="output">
 					<div class="col-md-12">
 						<ul class="role_menu">
 							<li><label><input type="checkbox" name="" value="">Menu Settings</label>
 								<ul>
 									<li><div class="menu"><label><input type="checkbox" name="" value="">Menu Setup</label></div><div class="permission"><label><input type="checkbox" name="" value="">Red</label><label><input type="checkbox" name="" value="">Create</label><label ><input type="checkbox" name="" value="">Edit</label><label><input type="checkbox" name="" value="">Del</label><label><input type="checkbox" name="" value="">Print</label><label><input type="checkbox" name="" value="">Down</label></div></li>
 								</ul>
 							</li>
 							<li><label><input type="checkbox" name="" value="">Role Settings</label>
 								<ul>
 									<li><div class="menu"><label><input type="checkbox" name="" value="">Division Setup</label></div><div class="permission"><label><input type="checkbox" name="" value="">Red</label><label><input type="checkbox" name="" value="">Create</label><label ><input type="checkbox" name="" value="">Edit</label><label><input type="checkbox" name="" value="">Del</label><label><input type="checkbox" name="" value="">Print</label><label><input type="checkbox" name="" value="">Down</label></div></li>
 								</ul>
 							</li>
 							<li><label><input type="checkbox" name="" value="">General Settings</label>
 								<ul>
 									<li><div class="menu"><label><input type="checkbox" name="" value="">Division Setup</label></div><div class="permission"><label><input type="checkbox" name="" value="">Red</label><label><input type="checkbox" name="" value="">Create</label><label ><input type="checkbox" name="" value="">Edit</label><label><input type="checkbox" name="" value="">Del</label><label><input type="checkbox" name="" value="">Print</label><label><input type="checkbox" name="" value="">Down</label></div></li>

 									<li><div class="menu"><label><input type="checkbox" name="" value="">Division Setup</label></div><div class="permission"><label><input type="checkbox" name="" value="">Red</label><label><input type="checkbox" name="" value="">Create</label><label ><input type="checkbox" name="" value="">Edit</label><label><input type="checkbox" name="" value="">Del</label><label><input type="checkbox" name="" value="">Print</label><label><input type="checkbox" name="" value="">Down</label></div></li>

 									<li><div class="menu"><label><input type="checkbox" name="" value="">Division Setup</label></div><div class="permission"><label><input type="checkbox" name="" value="">Red</label><label><input type="checkbox" name="" value="">Create</label><label ><input type="checkbox" name="" value="">Edit</label><label><input type="checkbox" name="" value="">Del</label><label><input type="checkbox" name="" value="">Print</label><label><input type="checkbox" name="" value="">Down</label></div></li>

 									<li><div class="menu"><label><input type="checkbox" name="" value="">Division Setup</label></div><div class="permission"><label><input type="checkbox" name="" value="">Red</label><label><input type="checkbox" name="" value="">Create</label><label ><input type="checkbox" name="" value="">Edit</label><label><input type="checkbox" name="" value="">Del</label><label><input type="checkbox" name="" value="">Print</label><label><input type="checkbox" name="" value="">Down</label></div></li>
 								</ul>
 							</li>
 						</ul>
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection