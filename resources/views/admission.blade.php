@extends('frontlayouts.main')
@section('content')
<div id="admission">
            <div class="container">
                <div class="heading">
                    <h3>Apply For Admission</h3>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-horizontal" id="regForm" action="demo.html" method="post">
                            <div class="formsegment">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="sessionid">Session</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="sessionid">
                                            <option value="">SELECT</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label" for="programid">Class</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="programid">
                                            <option value="">SELECT</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="groupid">Group</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="groupid">
                                            <option value="">SELECT</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="mediumid">
                                            <option value="">SELECT</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="shiftid">
                                            <option value="">SELECT</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
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
                                    <label class="col-md-2 control-label" for="example-text-input">Phone</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Phone" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="name">Father Name</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Father Name" id="name" name="name">
                                    </div>
                                    <label class="col-md-2 control-label" for="">Mother Name</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Mother Name" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="email">Email</label>
                                    <div class="col-md-4">
                                        <input type="email" class="form-control" placeholder="Email" id="email">
                                    </div>
                                    <label class="col-md-2 control-label" for="password">Password</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" placeholder="password" id="password">
                                    </div>
                                </div>
                            </div>
                            <div class="formsegment">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="devisionid">Division</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="sessionid">
                                            <option value="">SELECT</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label" for="districtid">District</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="programid">
                                            <option value="">SELECT</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="thanaid">Thana</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="sessionid">
                                            <option value="">SELECT</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label" for="postofficeid">Post Office</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="programid">
                                            <option value="">SELECT</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="unionid">Union</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="sessionid">
                                            <option value="">SELECT</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="presentaddress">Present Address</label>
                                    <div class="col-md-4">
                                        <textarea onchange="txtChange(this)" class="form-control" rows="5" id="presentaddress"></textarea>
                                    </div>
                                    <label class="col-md-2 control-label" for="permanentaddress">Permanent Address <br /><span>Same As Present Address</span>&nbsp;<input id="peraddress" onclick="check(this)" type="checkbox"></label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" rows="5" id="permanentaddress"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="name">Picture</label>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control-file">
                                    </div>
                                    <label class="col-md-2 control-label" for="">Signature</label>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control-file">
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