  <aside>
    <div id="sidebar" class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu">
        <li class="active">
          <a class="" href="{{URL::to('/')}}">
            <i class="icon_house_alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sub-menu">
          <a href="javascript:;" class="">
            <i class="icon_document_alt"></i>
            <span>Institute Settings</span>
            <span class="menu-arrow arrow_carrot-right"></span>
          </a>
          <ul class="sub">
           <li><a href="{{URL::to('/division')}}">Division SetUp</a></li>
           <li><a href="{{URL::to('/district')}}">District SetUp</a></li>
           <li><a href="{{URL::to('/thana')}}">Thana SetUp</a></li>
           <li><a href="{{URL::to('/localgov')}}">Union SetUp</a></li>
           <li><a href="{{URL::to('/postoffice')}}">Post Office SetUp</a></li>
           <li><a href="{{URL::to('/institutetype')}}">Institute Type SetUp</a></li>
           <li><a href="{{URL::to('/institutecategory')}}">Institute Category SetUp</a></li>
           <li><a href="{{URL::to('/institutesubcategory')}}">Sub Cat SetUp</a></li>
           <li><a href="{{URL::to('/institute')}}">Institute SetUp</a></li>
         </ul>
       </li>
       <li class="sub-menu">
        <a href="javascript:;" class="">
          <i class="icon_document_alt"></i>
          <span>Settings</span>
          <span class="menu-arrow arrow_carrot-right"></span>
        </a>
        <ul class="sub">
          <li><a href="{{URL::to('/session')}}">Session setup</a></li>
          <li><a href="{{URL::to('/programLevel')}}">Program Level</a></li> 
          <li><a href="{{URL::to('/group')}}">Group setup</a></li> 
          <li><a href="{{URL::to('/program')}}">Class setup</a></li> 
          <li><a href="{{URL::to('/medium')}}">Medium setup</a></li>
          <li><a href="{{URL::to('/shift')}}">Shift setup</a></li>
          <li><a href="{{URL::to('/programoffer')}}">Program Offer setup</a></li>
          <li><a href="{{URL::to('/course')}}">Subject Info</a></li>  
          <li><a href="{{URL::to('/subjectcode')}}">Subject Code</a></li>   
          <li><a href="{{URL::to('/courseoffer')}}">Course Offer setup</a></li> 
          <li><a href="{{URL::to('/section')}}">Section setup</a></li>   
        </ul>
      </li>
      <li class="sub-menu">
        <a href="javascript:;" class="">
          <i class="icon_desktop"></i>
          <span>Employee</span>
          <span class="menu-arrow arrow_carrot-right"></span>
        </a>
        <ul class="sub">
         <li><a href="{{URL::to('/employeeType')}}">Employee Type</a></li> 
         <li><a href="{{URL::to('/employeedesignation')}}">Employee Designation</a></li> 
         <li><a href="{{URL::to('/department')}}">Department</a></li> 
         <li><a href="{{URL::to('/employee')}}">Employee</a></li> 
       </ul>
     </li>
     <li class="sub-menu">
      <a href="javascript:;" class="">
        <i class="icon_desktop"></i>
        <span>Student</span>
        <span class="menu-arrow arrow_carrot-right"></span>
      </a>
      <ul class="sub">
       <!-- <li><a href="{{URL::to('/section')}}">Section setup</a></li> -->
       <li><a href="{{URL::to('/applicant')}}">Applicant</a></li>
     </ul>
   </li>


   <li class="sub-menu">
    <a href="javascript:;" class="">
      <i class="icon_table"></i>
      <span>Tables</span>
      <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
      <li><a class="" href="basic_table.html">Basic Table</a></li>
    </ul>
  </li>

  <li class="sub-menu">
    <a href="javascript:;" class="">
      <i class="icon_documents_alt"></i>
      <span>Pages</span>
      <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
      <li><a class="" href="profile.html">Profile</a></li>
      <li><a class="" href="login.html"><span>Login Page</span></a></li>
      <li><a class="" href="contact.html"><span>Contact Page</span></a></li>
      <li><a class="" href="blank.html">Blank Page</a></li>
      <li><a class="" href="404.html">404 Error</a></li>
    </ul>
  </li>

</ul>
<!-- sidebar menu end-->
</div>
</aside>