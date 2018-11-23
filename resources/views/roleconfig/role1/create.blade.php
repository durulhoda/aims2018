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
 								<option value="">Supper Admin</option>
 						</select>
 					</div>
 				</div>
 				<div class="row" id="output">
 					<div class="form-group col-sm-12">
 						<!-- <label>Access power  :</label><br/>
 						 <input type="checkbox" name="accesspower[]" value="1">Red &nbsp;&nbsp;
 						 <input type="checkbox" name="accesspower[]" value="1">Red &nbsp;&nbsp; -->
 					</div>
 					<div class=" col-sm-12">
 						<label>Menu Access  :</label><br/>
 					</div>
 					 @foreach($menus as $aObj)
 					 <div class="form-group col-sm-3">
                        <div class="checkbox">
                            <label><input type="checkbox" name="menu_id[]" value="{{$aObj->menu_id}}">{{$aObj->menuName}}</label><br>
                             <input type="checkbox" name="accesspower[]" value="1">Red &nbsp;&nbsp;<br>
 						     <input type="checkbox" name="accesspower[]" value="1">Red &nbsp;&nbsp;
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