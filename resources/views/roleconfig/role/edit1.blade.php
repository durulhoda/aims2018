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
 					<div class="form-group col-sm-3">
 						<input type="hidden" id="id" name="id" value="{{$bean->id}}">
 						<label for="name">Role  :</label>
 						<input type="text" class="form-control" id="name" name="name" value="{{$bean->name}}">
 					</div>
 					<div class="form-group col-sm-3">
 						<label class="control-label" for="rolecreatorid">Role Creator  &nbsp; </label>
 						<select onchange="editRolePower()" name="rolecreatorid" required="1" class="form-control" id="rolecreatorid">
 							@foreach($successorRole as $aObj)			
 							 @if($aObj->id!=$bean->id)			
 							 @if($bean->rolecreatorid==$aObj->id)
 							 <option selected="" value="{{$aObj->id}}">{{$aObj->name}}</option>
 							 @else
 							 <option value="{{$aObj->id}}">{{$aObj->name}}</option>
 							 @endif
 							@endif
 							@endforeach	
 						</select>
 					</div>
 				</div>
 				<div class="row" id="output">
 					<div class="col-md-12">
 						<ul class="role_menu">
 							@foreach($result as $x)
                              @if($x['item']->pparentid==0)
                                @if($x['item']->cmenuid!=0)
                                <li><label><input type="checkbox" checked=""  name="menu_id[]" value="{{$x['item']->pmenuid}}">{{$x['item']->menuName}}</label>
                                @endif
                              @endif
                            @endforeach
 						</ul>
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Update</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection