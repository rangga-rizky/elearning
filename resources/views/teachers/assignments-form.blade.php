 @include('layouts/header')
 <!-- <link rel="stylesheet" href="{{URL::to('plugins/datatables/dataTables.bootstrap.css')}}"> -->

  <!-- Left side column. contains the logo and sidebar -->
  
  
  <link rel="stylesheet" href="{{URL::to('bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />

@include('layouts/teacher_nav')
<div class="content-wrapper">
    <section class="content">

      <div class="row">

<div class="col-md-7">
              @if(isset($value))
                <?php $adaInput = 'true';?>
                @foreach($value as $val) 
                  <?php
                  // $isiInput['name'] = $val->name;
                  $isiInput['a_id'] = $val->id;
                  $isiInput['a_title'] = $val->title;
                  $isiInput['s_id'] = $val->session_id;
                  $isiInput['fix_date'] = $val->closed_time;
                  $temp = explode(" ", $isiInput['fix_date']);
                  $date = explode("-", $temp[0]);
                  $isiInput['closed_time'] = $date[2].'-'.$date[1].'-'.$date[0].' '.$temp[1];
                  $isiInput['description'] = $val->description;
                  // echo "<h4>".$isiInput['fix_date']."</h4>";
                  // echo "<h4>".$isiInput['closed_time']."</h4>";
                  ?>
                @endforeach
              @else
                <?php $adaInput = 'false';?>
              @endif
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title">
        @if($adaInput=='true')
          Update an assignment
        @else  
          Create an assignment
        @endif
        </h3>

            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
    </div>
    <div class="box-body">
      @if($adaInput=='true')
        <form action="../../../../assignments/update" method="post">
          <input type="hidden" name="a_id" value="{{$isiInput['a_id']}}">
      @else
        <form action="../../../assignments" method="post">
      @endif
        {{ csrf_field() }}
        <input type="hidden" name="session" value="{{$s_id}}">
        <input type="hidden" name="c_id" value="{{$course->id}}">
        <div class="form-group">
          <b>Course Name: {{$course->title}}</b><br>
          <b>Session Name: {{$session->title}}</b>
        </div>
          <div class="form-group">
            <label>Assignment title:</label>
            @if($adaInput=='true')
              <input value="{{$isiInput['a_title']}}" type="text" class="form-control" name="title">
            @else
              <input type="text" class="form-control" name="title">
            @endif
            
          </div><!-- /.form group -->
          <div class="form-group">
            <label>Closed time </label>
              <div class='input-group date' id='datetimepicker2'>
                  @if($adaInput=='true')
                    <input type='text' class="form-control" name="c_time"  value="{{$isiInput['closed_time']}}"/>
                  @else
                    <input type='text' class="form-control" name="c_time" />
                  @endif
                  @if($adaInput=='true')
                    <input type="hidden" name="closed_time" value="{{$isiInput['fix_date']}}">
                  @else
                    <input type="hidden" name="closed_time" >
                  @endif
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            <!-- <input type="text" name="closed_time" class="form-control"> -->
          </div>
          <!-- phone mask -->
          <div class="form-group">
            <label>Description </label>
              <textarea class="form-control" name="description">@if($adaInput=='true'){{$isiInput['description']}}@endif</textarea>
          </div><!-- /.form group -->
          @if($adaInput=='true')
            <input type="submit" class="btn btn-success" name="submit" value="Update" >
          @else  
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" >
          @endif
      </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div>

      </div><!-- /.row -->

    </section><!-- /.content -->
</div>
@include('layouts/footer')
<script src="{{URL::to('bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<style type="text/css">
  .bootstrap-datetimepicker-widget{
    z-index: 200000
  }
</style>
<script type="text/javascript">
    $(function () {
      $('#datetimepicker2').datetimepicker({
            locale: 'id',
            format: 'DD-MM-YYYY HH:mm:ss',
            // inline: true,
            // sideBySide: true 
        });
      $('#datetimepicker2').on("dp.change", function (e) {
          var closed_time = $('#datetimepicker2 input[name="c_time"]').val();
          var split_time = closed_time.split(' ');
          var date = split_time[0].split('-');
          var fix_date = date[2]+'-'+date[1]+'-'+date[0]+' '+split_time[1];
          console.log(closed_time);
          console.log(fix_date);
          $('#datetimepicker2 input[name="closed_time"]').val(fix_date);
            // $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            // console.log(e.date);
        });
      <?php  if ($adaInput=='true') { ?>
        $('input[name="closed_time"]').val(<?=$isiInput['fix_date']?>);
      <?php } ?>
    });
</script>