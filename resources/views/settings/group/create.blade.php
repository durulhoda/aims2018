 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Add New Group</h4>
 				<a href="{{URL::to('/group')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('group')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label class="control-label" for="programLevelid">Class/Program Level  &nbsp; </label>
 						<select name="programLevelid" required="1" class="form-control" id="programLevelid">
 							@foreach($levels as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="name">Group Name  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection