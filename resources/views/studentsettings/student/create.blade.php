 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Student</h4>
 				<a href="{{URL::to('/student')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('student')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-4">
 						<label for="name">Name  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 					<div class="form-group col-sm-4">
 						<label for="studentid">Student ID  :</label>
 						<input type="text" class="form-control" id="studentid" name="studentid">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection