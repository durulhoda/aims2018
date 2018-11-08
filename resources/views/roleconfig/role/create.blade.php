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
 						<label>Access power  :</label><br/>
 						<input type="checkbox" name="accesspower[]" value="1">read &nbsp;&nbsp;
 						<input type="checkbox" name="accesspower[]" value="2">create &nbsp;&nbsp;
 						<input type="checkbox" name="accesspower[]" value="4">Up &nbsp;&nbsp;
 						<input type="checkbox" name="accesspower[]" value="8">del &nbsp;&nbsp;
 						<input type="checkbox" name="accesspower[]" value="16">Print &nbsp;&nbsp;
 						<input type="checkbox" name="accesspower[]" value="32">down
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection