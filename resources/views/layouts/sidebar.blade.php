    <?php
   function menu(){
      return menucreate(0);
   }
   function menucreate($parentid){
    $menu = "";
    $result=\DB::select('SELECT * FROM `menus` where parentid=?',[$parentid]);
    foreach ($result as $key => $value) {
        $isTrue=hasChild($value->id);
        if($isTrue){
           $menu .="<li class='sub-menu'><a href='javascript:;'>".$value->name."</a>";
           $menu .= "<ul class='sub'>".menucreate($value->id)."</ul>";
       }else{
        $menu .="<li class=''><a href='".$value->url."'>".$value->name."</a>";
    }
    $menu .= "</li>";
}
return $menu;
}
function hasChild($parentid){
    $result=\DB::select('SELECT * FROM `menus` where parentid=?',[$parentid]);
    if($result){
        return true;
    }else{
        return false;
    }
}
   ?>
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
      <?php echo menu(); ?>
</ul>
<!-- sidebar menu end-->
</div>
</aside>