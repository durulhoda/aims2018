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
 					<div class="form-group col-sm-4">
 						<label for="name">Role  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 					<div class="form-group col-sm-8">
 						<?php
 							$read=(isset($accessStatus[1])? $accessStatus[1]:0);
 							$create=(isset($accessStatus[2])? $accessStatus[2]:0);
 							$up=(isset($accessStatus[4])? $accessStatus[4]:0);
 							$del=(isset($accessStatus[8])? $accessStatus[8]:0);
 							$print=(isset($accessStatus[16])? $accessStatus[16]:0);
 							$down=(isset($accessStatus[32])? $accessStatus[32]:0);
 						 ?>
 						<label>Access power  :</label><br/>
 						@if($read==1)
 						<input type="checkbox" name="accesspower[]" value="1">read &nbsp;&nbsp;
 						@endif
 						@if($create==1)
 						<input type="checkbox" name="accesspower[]" value="2">create &nbsp;&nbsp;
 						@endif
 						@if($up==1)
 						<input type="checkbox" name="accesspower[]" value="4">Up &nbsp;&nbsp;
 						@endif
 						@if($del==1)
 						<input type="checkbox" name="accesspower[]" value="8">del &nbsp;&nbsp;
 						@endif
 						@if($print==1)
 						<input type="checkbox" name="accesspower[]" value="16">Print &nbsp;&nbsp;
 						@endif
 						@if($down==1)
 						<input type="checkbox" name="accesspower[]" value="32">down
 						@endif
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection