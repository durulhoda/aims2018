@extends('frontlayouts.main')
@section('uniqueStyle')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<div id="admission">
    <div class="container">
        <div class="heading">
            <h3>Apply For Admission</h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{URL::to('admission')}}"  method="post" class="form-horizontal" id="regForm" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="formsegment">
                        <input type="hidden" value="{{$instituteId}}" name="instituteid" id="instituteid">
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="sessionid">Session</label>
                            <div class="col-sm-4">
                                <select onchange="getChange(this,'admissionsessiontoall')" class="form-control" name="sessionid" id="sessionid">
                                    <option value="">SELECT</option>
                                    @foreach($sessionList as $aObj)
                                    <option value="{{$aObj->id}}">{{$aObj->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 control-label" for="programid">Class</label>
                            <div class="col-sm-4">
                                <select onchange="getChange(this,'programofferviewtogroup')" class="form-control" name="programid" id="programid">
                                    <option value="">SELECT</option>
                                    @foreach($programList as $aObj)
                                    <option value="{{$aObj->id}}">{{$aObj->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="groupid">Group</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="groupid" id="groupid">
                                    <option value="">SELECT</option>
                                    @foreach($groupList as $aObj)
                                    <option value="{{$aObj->id}}">{{$aObj->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="mediumid" id="mediumid">
                                    <option value="">SELECT</option>
                                    @foreach($mediumList as $aObj)
                                    <option value="{{$aObj->id}}">{{$aObj->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="shiftid" id="shiftid">
                                    <option value="">SELECT</option>
                                    @foreach($shiftList as $aObj)
                                    <option value="{{$aObj->id}}">{{$aObj->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="formsegment">
                        <div class="form-group row">
                            <label class="col-md-2 control-label" for="name">Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                            </div>
                            <label class="col-md-2 control-label" for="genderid">Gender</label>
                            <div class="col-md-4">
                                <label><input type="radio" name="genderid" checked value="1">Boy</label>
                                <label><input type="radio" name="genderid" value="2">Girl</label>
                                <label><input type="radio" name="genderid" value="3">Others</label>
                            </div>                       
                        </div>
                        <div class="form-group row">
                         <label class="col-md-2 control-label" for="fatherName">Father Name</label>
                         <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Father Name" id="fatherName" name="fatherName">
                        </div>    
                        <label class="col-md-2 control-label" for="motherName">Mother Name</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Mother Name" id="motherName" name="motherName">
                        </div>                         
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label" for="fPhone">Father's Phone</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Phone" id="fPhone" name="fPhone">
                        </div>
                        <label class="col-md-2 control-label" for="mPhone">Mother's Phone</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Phone" id="mPhone" name="mPhone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label" for="dob">Date of Birth</label>
                        <div class="col-md-4 date" id="datetimepicker1">
                            <input type="text" class="form-control" id="dob" name="dob">
                        </div>
                        <label class="col-md-2 control-label" for="age">Age</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="age" id="age" name="age">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label" for="quotaid">Quota</label>
                        <div class="col-md-4">
                            <select class="form-control" name="quotaid" id="quotaid">
                                <option value="0">SELECT</option>
                                <option value="1">General</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label" for="nationalityid">Nationality</label>
                        <div class="col-md-4">
                            <select class="form-control" name="nationalityid" id="nationalityid">
                                <option value="1">Bangladeshi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label" for="religionid">Religion</label>
                        <div class="col-md-4">
                            <select class="form-control" name="religionid" id="religionid">
                                <option value="0">SELECT</option>
                                <option value="1">Islam</option>
                                <option value="2">Hindu</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label" for="birthregno">Birth Reg. No</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Birth Reg. No" id="birthregno" name="birthregno">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label" for="bloodgroupid">Blood Group</label>
                        <div class="col-md-4">
                            <select class="form-control" name="bloodgroupid" id="bloodgroupid">
                                <option value="0">SELECT</option>
                                <option value="1">A+</option>
                                <option value="2">B+</option>
                                <option value="3">AB+</option>
                                <option value="4">AB-</option>
                                <option value="2">O+</option>
                                <option value="2">A-</option>
                                <option value="2">B-</option>
                                <option value="2">O-</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="formsegment">
                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset>
                                <legend>Present Address</legend>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label" for="devisionid">Division</label>
                                    <div class="col-sm-8">
                                        <select onchange="getChange(this,'divisionToDistrict')" class="form-control" name="divisionid" id="divisionid">
                                            <option value="">SELECT</option>
                                            @foreach($divisionList as $aObj)
                                            <option value="{{$aObj->id}}">{{$aObj->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label" for="districtid">District</label>
                                    <div class="col-sm-8">
                                        <select onchange="getChange(this,'districtToThana')" class="form-control" name="districtid" id="districtid">
                                            <option value="">SELECT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label" for="thanaid">Thana</label>
                                    <div class="col-sm-8">
                                        <select onchange="getChange(this,'thanaToPostoffice')" class="form-control" name="thanaid" id="thanaid">
                                            <option value="">SELECT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label" for="postofficeid">Post Office</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="postofficeid" id="postofficeid">
                                            <option value="">SELECT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label" for="localgovid">Union</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="localgovid" id="localgovid">
                                            <option value="">SELECT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 control-label" for="address">Address</label>
                                    <div class="col-md-8">
                                        <textarea onchange="txtChange(this)" class="form-control" rows="4" id="address" name="address"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                           <fieldset style="position: relative;">
                            <div style="position: absolute;top: 5px;right: 5px;"><input id="isChecked" name="isChecked" onclick="check(this)" type="checkbox">&nbsp;&nbsp;<span>Same As Present Address</span></div>
                            <legend>Permanent Address</legend>
                            <div class="form-group row">
                                <label class="col-sm-4 control-label" for="devisionid2">Division</label>
                                <div class="col-sm-8">
                                    <select onchange="getChange(this,'divisionToDistrict2')" class="form-control" name="devisionid2" id="devisionid2">
                                        <option value="">SELECT</option>
                                        @foreach($divisionList as $aObj)
                                        <option value="{{$aObj->id}}">{{$aObj->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                               <label class="col-sm-4 control-label" for="districtid2">District</label>
                               <div class="col-sm-8">
                                <select onchange="getChange(this,'districtToThana2')" class="form-control" name="districtid2" id="districtid2">
                                    <option value="">SELECT</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 control-label" for="thanaid">Thana</label>
                            <div class="col-sm-8">
                                <select onchange="getChange(this,'thanaToPostoffice2')" class="form-control" name="thanaid2" id="thanaid2">
                                    <option value="">SELECT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="postofficeid2">Post Office</label>
                           <div class="col-sm-8">
                            <select class="form-control" name="postofficeid2" id="postofficeid2">
                                <option value="">SELECT</option>
                            </select>
                        </div>    
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label" for="localgovid2">Union</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="localgovid2" id="localgovid2">
                                <option value="">SELECT</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 control-label" for="address2">Address</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="4" id="address2" name="address2"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 control-label" for="pictureurl">Picture</label>
            <div class="col-md-4">
                <input type="file" class="form-control-file" id="pictureurl" name="pictureurl">
            </div>
            <label class="col-md-2 control-label" for="signatureurl">Signature</label>
            <div class="col-md-4">
                <input type="file" class="form-control-file" name="signatureurl" id="signatureurl">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-md-2 col-md-4">
            <button type="button" id="prevBtn" class="btn btn-info waves-effect waves-light" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" class="btn btn-info waves-effect waves-light" onclick="nextPrev(1)">Next</button>
        </div>
    </div>
</form>
</div> <!-- col -->
</div> <!-- End row -->
</div>
</div>
@endsection
@section('uniqueScript')
<!-- for admission form -->
<script src="{{asset('fontend/assets/js/studentReg.js')}}"></script>
<script type="text/javascript">
    $( function() {
        $( "#dob" ).datepicker();
    } );
</script>
@endsection