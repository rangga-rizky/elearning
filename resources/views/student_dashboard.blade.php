 @include('layouts/header')
 @include('layouts/student_sidebar')



 <!-- Content Wrapper. Contains page content -->
 <div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title">Event</h4>
            </div>
            <div id="modalBody" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>Welcome to <strong>Elearning Laravel</strong><br><small>my courses !</small>
      </h1>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->

    <!-- /.row -->
    <!-- Main row -->
    <div class="row" >
      <div class="col-md-8">
        <div class="row">
          <?php $color = ['red','green','yellow','blue']  ?>
          @if(count($courses) > 0)
          @foreach($courses as $course)
          <div class="col-md-6">
            <div class="info-box">
             <!-- Apply any bg-* class to to the icon to color it -->
             <span class="info-box-icon bg-{{$color[rand(0,3)]}}"><i class="fa fa-star-o"></i></span>
             <a href="{{ url('courses/'.$course->id) }}">
              <div class="info-box-content">
                <span class="info-box-number">{{ $course->title}}</span>              
                <span class="info-box-text">{{ $course->description}}</span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>           
        </div>
        @endforeach
        @else
        <div class="panel panel-default">
          <div class="panel-body">Anda Belum Enroll pada Kursus apapun! buka <a href="{{URL::to('courses/student')}}">Katalog</a></div>
        </div>

        @endif
      </div>
    </div>
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div id="kalender"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
  </div>
  <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>



<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>


<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{URL::to('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::to('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{URL::to('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{URL::to('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{URL::to('bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{URL::to('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{URL::to('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{URL::to('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{URL::to('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{URL::to('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{URL::to('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{URL::to('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{URL::to('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{URL::to('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::to('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::to('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{URL::to('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{URL::to('dist/js/demo.js')}}"></script>

<script src="{{URL::to('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function() {

      // page is var date = new Date()
      var date = new Date()
      var d    = date.getDate(),
      m    = date.getMonth(),
      y    = date.getFullYear()
       Date.createFromMysql = function(mysql_string)
      { 
       var t, result = null;

       if( typeof mysql_string === 'string' )
       {
        t = mysql_string.split(/[- :]/);

      //when t[3], t[4] and t[5] are missing they defaults to zero
      result = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);          
      }

        return result;   
      }

      $('#kalender').fullCalendar({
        week: true,
        day: true,
        editable  : false,
        events    : [
        <?php foreach ($events as $event) {?>
          {
            title          : '{{ $event["name"] }}',
            start          : Date.createFromMysql("{{$event['time']}}"),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        
        <?php } ?>
        ],
         eventClick:  function(event, jsEvent, view) {
           // $('#modalTitle').html(event.title);
            $('#modalBody').html(event.title);
            $('#eventUrl').attr('href',event.url);
            $('#fullCalModal').modal();
        }

      })   




});
</script>
</body>
</html>
