 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Menu</h4>
 				<a href="{{URL::to('/menu')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-md-12">
 			<form action="{{URL::to('menu')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-md-4">
 						<label for="name">Name  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 					<div class="form-group col-md-4">
 						<label class="control-label" for="parentid">Parent  &nbsp; </label>
 						<select name="parentid" required="1" class="form-control" id="parentid">
 							<option value="0">No Parent</option>
 							@foreach($parents as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-md-4">
 						<label for="url">Route  :</label>
 						<input type="text" class="form-control" id="url" name="url">
 					</div>
 					<div class="form-group col-md-4">
 						<label for="menuorder">Menu Order  :</label>
 						<input type="text" class="form-control" id="menuorder" name="menuorder">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection