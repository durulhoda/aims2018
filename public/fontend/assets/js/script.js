 $(document).ready(function () {
     $('.slider').bxSlider({
         mode: 'fade',
         responsive: true,
         infiniteLoop: true,
         auto: true,
         speed: 1000
     });
     $('.counter').counterUp({
         delay: 10,
         time: 1000
     });
 });

 //$("li.has-sub").hover(function(){
 //    $(this).css("background-color", "yellow");
 //    }, function(){
 //    $(this).css("background-color", "pink");
 //});
