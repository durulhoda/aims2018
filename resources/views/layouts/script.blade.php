<script src="{{asset('admin/js/jquery.js')}}"></script>
<script src="{{asset('admin/js/jquery-ui-1.10.4.min.js')}}"></script>
<script src="{{asset('admin/js/jquery-1.8.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/jquery-ui-1.9.2.custom.min.js')}}"></script>

<!-- bootstrap -->
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<!-- bootstrap timepicker -->
<script src="{{asset('admin/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap-datepicker.min.js')}}"></script>
<!-- nice scroll -->
<script src="{{asset('admin/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.nicescroll.js')}}"></script>
<!-- charts scripts -->
<script src="{{asset('admin/assets/jquery-knob/js/jquery.knob.js')}}"></script>
<script src="{{asset('admin/js/jquery.sparkline.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
<script src="{{asset('admin/js/owl.carousel.js')}}"></script>
<!-- jQuery full calendar -->
<<script src="{{asset('admin/js/fullcalendar.min.js')}}"></script>
<!-- Full Google Calendar - Calendar -->
<script src="{{asset('admin/assets/fullcalendar/fullcalendar/fullcalendar.js')}}"></script>
<!--script for this page only-->
<script src="{{asset('admin/js/calendar-custom.js')}}"></script>
<script src="{{asset('admin/js/jquery.rateit.min.js')}}"></script>
<!-- custom select -->
<script src="{{asset('admin/js/jquery.customSelect.min.js')}}"></script>
<script src="{{asset('admin/assets/chart-master/Chart.js')}}"></script>

<!--custome script for all page-->
<script src="{{asset('admin/js/scripts.js')}}"></script>
<!-- custom script for this page-->
<script src="{{asset('admin/js/sparkline-chart.js')}}"></script>
<script src="{{asset('admin/js/easy-pie-chart.js')}}"></script>
<script src="{{asset('admin/js/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('admin/js/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('admin/js/xcharts.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.autosize.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.placeholder.min.js')}}"></script>
<script src="{{asset('admin/js/gdp-data.js')}}"></script>
<script src="{{asset('admin/js/morris.min.js')}}"></script>
<script src="{{asset('admin/js/sparklines.js')}}"></script>
<script src="{{asset('admin/js/charts.js')}}"></script>
<script src="{{asset('admin/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('admin/js/multiselect.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script>
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#datalist tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true
        });
$('#framework').multiselect({
  nonSelectedText: 'Select',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'100%',
  buttonClass: 'btn btn-link',
  includeSelectAllOption: true,
  
 });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
        $('#timepicker1').timepicker();  
        $('#timepicker2').timepicker();  
    </script>
    <!-- custom script for this page-->
    <script src="{{asset('admin/js/ajax.js')}}"></script>