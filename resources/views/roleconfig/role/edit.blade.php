 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Edit Role</h4>
 				<a href="{{URL::to('/role')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('role')}}/{{$bean->id}}" method="POST">
 				@method('PUT')
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-3">
 						<input type="hidden" id="id" name="id" value="{{$bean->id}}">
 						<label for="name">Role  :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 					<div class="form-group col-sm-3">
 						<label class="control-label" for="rolecreatorid">Role Creator  &nbsp; </label>
 						<select onchange="editRolePower()" name="rolecreatorid" required="1" class="form-control" id="rolecreatorid">
 						 @foreach($successorRole as $aObj)
 						    @if($aObj->id!=$bean->id)			
 							 @if($bean->rolecreatorid==$aObj->id)
 							 <option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							 @else
 							 <option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							 @endif
 							@endif
 						 @endforeach	
 						</select>
 					</div>
 				</div>
 				<div class="row" id="output">
 					 @foreach($result as $aObj)
 					 @if($aObj['item']->cmenuid!=0)
                     <div class="form-group col-sm-4">
                            <label style="color: red"><input checked="" type="checkbox" name="menu_id[]" value="{{$aObj['item']->pmenuid}}">{{$aObj['item']->menuName}}</label><br>
                             @foreach($aObj['parentPositionValue'] as $bpv)
                            	@if($aObj['meargeResult'][$bpv]!=0)
                            	 <label><input checked="" type="checkbox" name="permissionvalue_{{$aObj['item']->pmenuid}}[]" value="{{$bpv}}">{{$permissionNameList[$bpv]}} &nbsp;&nbsp;</label>
                            	 @else
                            	  <label><input  type="checkbox" name="permissionvalue_{{$aObj['item']->pmenuid}}[]" value="{{$bpv}}">{{$permissionNameList[$bpv]}} &nbsp;&nbsp;</label>
                            	@endif
                             @endforeach
                     </div>
                     @else
                     <div class="form-group col-sm-4">
                            <label style="color: red"><input type="checkbox" name="menu_id[]" value="{{$aObj['item']->pmenuid}}">{{$aObj['item']->menuName}}</label><br>
                             @foreach($aObj['parentPositionValue'] as $bpv)
                             <label><input type="checkbox" name="permissionvalue_{{$aObj['item']->pmenuid}}[]" value="{{$bpv}}">{{$permissionNameList[$bpv]}} &nbsp;&nbsp;</label>
                             @endforeach
                     </div>
                     @endif  
                    @endforeach 
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection