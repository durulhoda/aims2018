<!DOCTYPE html>
<html lang="en">

<head>
 @include('layouts.head')
</head>
<body>
  <!-- container section start -->
  <section id="container" class="">
   <!--header start-->
   @include('layouts.header')
   <!--header end-->
   <!--sidebar start-->
   @include('layouts.sidebar')
   <!--sidebar end-->

   <!--main content start-->
   <section id="main-content">
      @yield('content')
  </section>
  <!--main content end-->
</section>
<!-- container section end -->
<!-- javascripts -->
 @include('layouts.script')
  </body>

  </html>
