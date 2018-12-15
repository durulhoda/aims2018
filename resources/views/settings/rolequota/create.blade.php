 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Quota Assign to Role</h4>
 				<a href="{{URL::to('/rolequota')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12">
 			<form action="{{URL::to('rolequota')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="form-group col-sm-3">
 						<label class="control-label" for="roleid">Role &nbsp; </label>
 						<select name="roleid" required="1" class="form-control" id="roleid">
 							@foreach($successorRole as $aObj)			
 							<option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							@endforeach	
 						</select>
 					</div>
 				</div>
 				<div class="row">
 					<div class="form-group col-sm-12">
 						@foreach($quotaListByRoleId as $x)
 						<label><input type="checkbox" name="quotaid[]" value="{{$x->quotaid}}"> &nbsp;&nbsp;{{$x->quotaName}}:</label>&nbsp;&nbsp;
 						@endforeach
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection