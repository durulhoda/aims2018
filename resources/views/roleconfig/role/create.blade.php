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
 							@foreach($menuListByRoleId as $x)
 							@if($x['item']->parentid==0)
 							<li><label><input type="checkbox" name="menuid[]" value="{{$x['item']->id}}">{{$x['item']->menuName}}</label>
 							<ul>
 								@foreach($menuListByRoleId as $y)
 								  @if($x['item']->id==$y['item']->parentid)
 									<li>
 										<div class="menu">
 											<label><input type="checkbox" name="menuid[]" value="{{$y['item']->id}}">{{$y['item']->menuName}}</label>
 										</div>
 										<div class="permission">
 										@foreach($y['binaryPositionValue'] as $bpv)
 										<label><input type="checkbox" name="permissionvalue_{{$y['item']->id}}[]" value="{{$bpv}}">{{$permissionNameList[$bpv]}} &nbsp;&nbsp;</label>
 										@endforeach
 									</div></li>
 								   @endif
 								@endforeach
 							</ul>
 							</li>
 							@endif
 							@endforeach
 						</ul>
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection