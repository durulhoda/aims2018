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
 					<?php
 					        $option=array();
 					        $option[1]="Read";
 					        $option[2]="create";
 					        $option[4]="Up";
 					        $option[8]="del";
 					        $option[16]="Print";
 					        $option[32]="Down";
 						 ?>
 					<div class="form-group col-sm-3">
 						<label class="control-label" for="rolecreatorid">Role Creator  &nbsp; </label>
 						<select onchange="createRolePower()" name="rolecreatorid" required="1" class="form-control" id="rolecreatorid">
 							<option value="{{$rolecreatorid}}">Select</option>
 							@foreach($roleCreators as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 				</div>
 				<div class="row" id="output">
 					<div class="form-group col-sm-12">
 						<label>Access power  :</label><br/>
 						@foreach($rolepower['accessPower'] as $val)
 						 <input type="checkbox" name="accesspower[]" value="{{$val}}">{{$option[$val]}} &nbsp;&nbsp;
 						@endforeach
 					</div>
 					<div class=" col-sm-12">
 						<label>Menu Access  :</label><br/>
 					</div>
 					@foreach($rolepower['menusAccess'] as $aObj)
 					 <div class="form-group col-sm-3">
                        <div class="checkbox">
                            <label><input type="checkbox" name="menu_id[]" value="{{$aObj->id}}">{{$aObj->menuName}}</label>
                        </div>
                    </div>	
                    @endforeach				
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection