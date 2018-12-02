 @extends('layouts.main')
 @section('content')
 <section class="wrapper">
    <!--overview start-->
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <h4>New Role</h4>
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
                            @foreach($menuListByRoleId as $x)
                            @if($x['item']->parentid==0)
                             @if($x['item']->cmenuid!=0)
                             <li><label><input type="checkbox" checked="" name="menuid[]" value="{{$x['item']->id}}">{{$x['item']->menuName}}</label>
                             @else
                             <li><label><input type="checkbox" name="menuid[]" value="{{$x['item']->id}}">{{$x['item']->menuName}}</label>
                             @endif
                            <ul>
                                @foreach($menuListByRoleId as $y)
                                  @if($x['item']->id==$y['item']->parentid)
                                    <li>
                                        @if($y['item']->cmenuid!=0)
                                        <div class="menu">
                                            <label><input type="checkbox" checked="" name="menuid[]" value="{{$y['item']->id}}">{{$y['item']->menuName}}</label>
                                        </div>
                                        @else
                                        <div class="menu">
                                            <label><input type="checkbox" name="menuid[]" value="{{$y['item']->id}}">{{$y['item']->menuName}}</label>
                                        </div>
                                        @endif
                                        <div class="permission">
                                        @foreach($y['parentPositionValue'] as $bpv)
                                        @if($y['meargeResult'][$bpv]!=0)
                                         <label><input type="checkbox" checked="" name="permissionvalue_{{$y['item']->id}}[]" value="{{$bpv}}">{{$permissionNameList[$bpv]}} &nbsp;&nbsp;</label>
                                        @else
                                         <label><input type="checkbox" name="permissionvalue_{{$y['item']->id}}[]" value="{{$bpv}}">{{$permissionNameList[$bpv]}} &nbsp;&nbsp;</label>
                                        @endif
                                        @endforeach
                                       </div>
                                   </li>
                                   @endif
                                @endforeach
                            </ul>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Save</button>
            </form>
        </div>
    </div>
 </section>
 @endsection