 @include('layouts/header')
 @include('layouts/student_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header">
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>{{ $questions[0]->quiz["title"]}}
      </h1>      
      <small>Take a Quiz</small>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    
    <div class="row">

      <div class="col-md-8" style="background: white;">
        <div  class="card" style="padding:20px">
          <div class="card-body">
           <div class="questions">
             @include('student/load_question')
           </div>
         </div>

         <div id="pagination-container" style="margin-top:10px;  "></div>
         <div>
           <button style="float: right;margin: 15px" class="btn btn-primary" id="submit" >Finish</button>
         </div>


       </div>

     </div>

   </div>






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
<script type="text/javascript">

  $(function() {
    var jawaban = [];
    <?php foreach ($quiz->questions as $question) { ?>
      jawaban[{{$question->number_order-1}}] = [];
      jawaban[{{$question->number_order-1}}][0] = '{{$question->id}}';
      jawaban[{{$question->number_order-1}}][1] = null;
     <?php } ?> 

    $('body').on('click', '.pagination a', function(e) {
      e.preventDefault();
      qid = $('input[name=id]').val();
      is_essay = $('input[name=is_essay]').val();
      number = $('input[name=number]').val();
      if(is_essay == 1){
        jawaban[number-1][0] = qid;
        jawaban[number-1][1] = $('input[name=ans_'+qid+']').val();
      }else{
        jawaban[number-1][0] = qid;
        jawaban[number-1][1] = $('input[name=ans_'+qid+']:checked').val();
      }

      $('#load a').css('color', '#dfecf6');

      var url = $(this).attr('href');  
      getQ(url);
      window.history.pushState("", "", url);
    });

    function getQ(url) {
      $.ajax({
        url : url  
      }).done(function (data) {
        $('.questions').html(data);  
        is_essay = $('input[name=is_essay]').val();
        qid = $('input[name=id]').val();
        number = $('input[name=number]').val();
      
        if(jawaban[number-1][1]!=null){
          if(is_essay == 1){
            $('input[name=ans_'+qid+']').val(jawaban[number-1][1]);
          }else{
            $('input[value='+jawaban[number-1][1]+']').prop('checked', true); 
          }
        }

      }).fail(function () {
        alert('Question could not be loaded.');
      });
    }

    $('body').on('click', '#submit', function(e) {

      e.preventDefault();
      qid = $('input[name=id]').val();
      is_essay = $('input[name=is_essay]').val();
      number = $('input[name=number]').val();
      if(is_essay == 1){
        jawaban[number-1][0] = qid;
        jawaban[number-1][1] = $('input[name=ans_'+qid+']').val();
      }else{
        jawaban[number-1][0] = qid;
        if($('input[name=ans_'+qid+']:checked').val() == null){
          jawaban[number-1][1] = null;
        }else{
          jawaban[number-1][1] = $('input[name=ans_'+qid+']:checked').val();
        }
      }

      var r = confirm("Are you sure to Finish it!");
      if (r == true) {
        $.ajax({
         type: "POST",
         data: {answers:jawaban},
         url: "{{ url('student_answer') }}",
         success: function(msg){
           window.location.replace('<?php echo url("quiz/student/".$quiz->id) ?>');
         }
       });
      } 

    });  


  });

</script>
</body>
</html>
