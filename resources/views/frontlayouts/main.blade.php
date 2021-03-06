<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontlayouts.head')
    @yield('uniqueStyle')
    @include('frontlayouts.stylebottom')
</head>

<body>
    <div>
        <!-- Heaer Section -->
        @include('frontlayouts.header')
       
        <!-- Main Content Section -->
        <section id="main-content">
             @yield('content')
        </section>
        
        <!--    Footer Top Section-->
         @include('frontlayouts.footer')
    </div>
  @include('frontlayouts.mobile')
  @include('frontlayouts.script')
  @yield('uniqueScript')
</body>

</html>
