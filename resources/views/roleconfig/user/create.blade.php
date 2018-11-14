 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New User</h4>
 				<a href="{{URL::to('/user')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('user')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label for="name">Name  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="email">Email  :</label>
 						<input type="email" class="form-control" id="email" name="email">
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="password">Password  :</label>
 						<input type="password" class="form-control" id="password" name="password">
 					</div>
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="role_id">Role  &nbsp; </label>
 						<select name="role_id" required="1" class="form-control" id="role_id">
 							<option value="0">Select</option>
 							@foreach($roles as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection