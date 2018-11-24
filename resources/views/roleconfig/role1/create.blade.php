 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Role</h4>
 				<a href="{{URL::to('/role1')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('role1')}}" method="POST">
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
 					<div class="form-group col-sm-12">
 					</div>
 					 @foreach($menus as $aObj)
 					 <div class="form-group col-sm-4">
                            <label style="color: red"><input type="checkbox" name="menu_id[]" value="{{$aObj['item']->menu_id}}">{{$aObj['item']->menuName}}</label><br>
                             @foreach($aObj['binaryPositionValue'] as $bpv)
                             <label><input type="checkbox" name="permissionvalue_{{$aObj['item']->menu_id}}[]" value="{{$bpv}}">{{$permissionNameList[$bpv]}} &nbsp;&nbsp;</label>
                             @endforeach
                    </div>	
                    @endforeach	
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection