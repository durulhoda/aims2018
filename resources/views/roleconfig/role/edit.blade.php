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
 					<div class="form-group col-sm-4">
 						<label for="name">Role  :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 					<div class="form-group col-sm-8">
 						<?php
 							$read=(isset($access[1])? $access[1]:0);
 							$create=(isset($access[2])? $access[2]:0);
 							$up=(isset($access[4])? $access[4]:0);
 							$del=(isset($access[8])? $access[8]:0);
 							$print=(isset($access[16])? $access[16]:0);
 							$down=(isset($access[32])? $access[32]:0);
 						 ?>
 						<label>Access power  :</label><br/>
 						@if($read==1)
 						<input type="checkbox" checked="" name="accesspower[]" value="1">read &nbsp;&nbsp;
 						@else
 						<input type="checkbox" name="accesspower[]" value="1">read &nbsp;&nbsp;
 						@endif
 						@if($create==2)
 						<input type="checkbox" checked="" name="accesspower[]" value="2">create &nbsp;&nbsp;
 						@else
 						<input type="checkbox" name="accesspower[]" value="2">create &nbsp;&nbsp;
 						@endif
 						@if($up==4)
 						<input type="checkbox" checked name="accesspower[]" value="4">Up &nbsp;&nbsp;
 						@else
 						<input type="checkbox" name="accesspower[]" value="4">Up &nbsp;&nbsp;
 						@endif
 						@if($del==8)
 						<input type="checkbox" checked name="accesspower[]" value="8">del &nbsp;&nbsp;
 						@else
 						<input type="checkbox" name="accesspower[]" value="8">del &nbsp;&nbsp;
 						@endif
 						@if($print==16)
 						<input type="checkbox" checked name="accesspower[]" value="16">Print &nbsp;&nbsp;
 						@else
 						<input type="checkbox" name="accesspower[]" value="16">Print &nbsp;&nbsp;
 						@endif
 						@if($down==32)
 						<input type="checkbox" checked name="accesspower[]" value="32">Down &nbsp;&nbsp;
 						@else
 						<input type="checkbox" name="accesspower[]" value="32">Down &nbsp;&nbsp;
 						@endif
 					</div>
 				</div>
 				<button type="Update" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection