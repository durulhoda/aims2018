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
 					<input type="hidden" class="form-control" id="id" name="id" value="{{$bean->id}}">
 					<div class="form-group col-sm-3">
 						<label for="name">Role  :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 					<?php
 					        $option=array();
 					        $option[1]="Read";
 					        $option[2]="create";
 					        $option[4]="Up";
 					        $option[8]="del";
 					        $option[16]="Print";
 					        $option[32]="Down";
 					        $value=array();
 					        foreach($rolepower['accessPower'] as $val) {
 					        	$value[$val]=(isset($access[$val])? $access[$val]:0);
 					        }
 						 ?>
 					<div class="form-group col-sm-3">
 						<label class="control-label" for="rolecreatorid">Role Creator  &nbsp; </label>
 						<select onchange="editRolePower()" name="rolecreatorid" required="1" class="form-control" id="rolecreatorid">
 							@foreach($roleCreators as $aObj)
 							@if($aObj->id==$bean->rolecreatorid)
 							<option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@else
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endif
 							@endforeach
 						</select>
 					</div>
 				</div>
 				<div class="row" id="output">
 					<div class="form-group col-sm-12">
 						<label>Access power  :</label><br/>
 						@foreach($rolepower['accessPower'] as $val)
 						@if($value[$val]==$val)
 						  <input type="checkbox" checked  name="accesspower[]" value="{{$val}}"> {{$option[$val]}} &nbsp;&nbsp;
 						  @else
 						  <input type="checkbox" name="accesspower[]" value="{{$val}}">{{$option[$val]}} &nbsp;&nbsp;
 						  @endif
 						@endforeach
 					</div>
 					<div class=" col-sm-12">
 						<label>Menu Access  :</label><br/>
 					</div>
 					@foreach($result as $aObj)
 					 <div class="form-group col-sm-3">
                        <div class="checkbox">
                        	@if($aObj->id==0)
                            <label><input type="checkbox"  name="menu_id[]" value="{{$aObj->menu_id}}">{{$aObj->menuName}}</label>
                            @else
                            <label><input type="checkbox" checked="" name="menu_id[]" value="{{$aObj->menu_id}}">{{$aObj->menuName}}</label>
                            @endif
                        </div>
                    </div>	
                    @endforeach				
 				</div>
 				<button type="Update" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection