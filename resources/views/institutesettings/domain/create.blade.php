 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>New Domain</h4>
 				<a href="{{URL::to('/domain')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('domain')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					@if($roleid==1)
 					<div class="col-xs-10 col-sm-4">
 						<label class="control-label" for="instituteid">Institute  &nbsp; </label>
 						<select name="instituteid" required="1" class="form-control" id="instituteid">
 							@foreach($instituteList as $aObj)
 								<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach
 						</select>
 					</div>
 					@else
 					<input type="hidden" class="form-control" id="instituteid" name="instituteid" value="{{$instituteList[0]->id}}">
 					@endif
 					<div class="form-group col-sm-4">
 						<label for="name">Domain Name  :</label>
 						<input type="text" class="form-control" id="name" name="name">
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection