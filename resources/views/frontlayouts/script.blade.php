   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{asset('fontend/assets/js/jquery.mmenu.all.js')}}"></script>
    <script src="{{asset('fontend/assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('fontend/assets/js/jquery.counterup.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="{{asset('fontend/assets/js/jquery.steps.min.js')}}"></script>
    <script src="{{asset('fontend/assets/js/studentReg.js')}}"></script>
    <script src="{{asset('fontend/assets/js/script.js')}}"></script>
    <script src="{{asset('fontend/assets/js/ajax.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#mmmenu").mmenu();
            var API = $("#mmmenu").data("mmenu");
            $("#mmmenu").click(function() {
                API.open();
            });
        });

    </script>