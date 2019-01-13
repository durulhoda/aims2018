@extends('frontlayouts.main')
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
                            <label class="col-md-2 control-label" for="phone">Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone">
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
                        <!-- <div class="form-group row">
                            <label class="col-md-2 control-label" for="email">Email</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control" placeholder="Email" id="email">
                            </div>
                            <label class="col-md-2 control-label" for="password">Password</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" placeholder="password" id="password">
                            </div>
                        </div> -->
                    </div>
                    <div class="formsegment">
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="devisionid">Division</label>
                            <div class="col-sm-4">
                                <select onchange="getChange(this,'divisionToDistrict')" class="form-control" name="divisionid" id="divisionid">
                                    <option value="">SELECT</option>
                                     @foreach($divisionList as $aObj)
                                     <option value="{{$aObj->id}}">{{$aObj->name}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 control-label" for="districtid">District</label>
                            <div class="col-sm-4">
                                <select onchange="getChange(this,'districtToThana')" class="form-control" name="districtid" id="districtid">
                                    <option value="">SELECT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="thanaid">Thana</label>
                            <div class="col-sm-4">
                                <select onchange="getChange(this,'thanaToPostoffice')" class="form-control" name="thanaid" id="thanaid">
                                    <option value="">SELECT</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label" for="postofficeid">Post Office</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="postofficeid" id="postofficeid">
                                    <option value="">SELECT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="localgovid">Union</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="localgovid" id="localgovid">
                                    <option value="">SELECT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label" for="presentaddress">Present Address</label>
                            <div class="col-md-4">
                                <textarea onchange="txtChange(this)" class="form-control" rows="5" id="presentaddress" name="presentaddress"></textarea>
                            </div>
                            <label class="col-md-2 control-label" for="permanentaddress">Permanent Address <br /><span>Same As Present Address</span>&nbsp;<input id="peraddress" onclick="check(this)" type="checkbox"></label>
                            <div class="col-md-4">
                                <textarea class="form-control" rows="5" id="permanentaddress" name="permanentaddress"></textarea>
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