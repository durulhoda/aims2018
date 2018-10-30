 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
 	<!--overview start-->
 	<div class="row bgtable">
 		<div class="col-lg-12">
 			<div class="">
 				<h4>Subject Offer Information</h4>
 				<a href="{{URL::to('/courseoffer')}}">All</a>
 			</div>
 		</div>
 	</div>
 	<!--overview start-->
 	<div class="row">
 		<div class="col-lg-12 bgtable">
 			<form action="{{URL::to('courseoffer')}}" method="POST">
 				{{csrf_field()}}
 				<div class="row">
 					<div class="col-md-12">
 						<ul>
 							<input type="hidden" name="programofferid" value="{{$bean->id}}">
 							<li>Session :</li>
 							<li>{{$bean->sessionName}}</li>
 							<li>Class :</li>
 							<li>{{$bean->programName}}</li>
 							<li>Shift :</li>
 							<li>{{$bean->shiftName}}</li>
 							<li>Group :</li>
 							<li>{{$bean->groupName}}</li>
 							<li>Medium :</li>
 							<li>{{$bean->mediumName}}</li>
 						</ul>
 					</div>
 				</div>
 				<div class="row">
 					<!-- ///////////////////////// -->
 					<div class="col-md-12">
 						<div class="table-responsive bgtable">
 							<table class="table table-bordered">
 								<thead>
 									<tr>
 										<th width="10%">Select</th>
 										<th width="30%">Subject Name</th>
 										<th width="15%">Subject Code</th>
 										<th width="15%">Marks</th>
 									</tr>
 								</thead>
 								<tbody>

 									@foreach($courses as $aObj)
 									<tr>
 										<td><input type="checkbox" name="check[]" value="<?php echo $aObj->id; ?>"></td>
 										<td>
 											{{$aObj->courseName}}
 										</td>
 										<td><input type="hidden" name="subjectcodeid_<?php echo $aObj->id; ?>" value="{{$aObj->id}}">
 											{{$aObj->name}}
 										</td>
 										<td style="padding: 0px;"><input type="text" class="form-control"  name="marks_<?php echo $aObj->id; ?>" id="marks"></td>
 									</tr>
 									@endforeach
 								</tbody>
 							</table>
 						</div>
 					</div>
 				</div>
 				<button type="submit" class="btn btn-default">Save</button>
 			</form>
 		</div>
 	</div>
 </section>
 @endsection