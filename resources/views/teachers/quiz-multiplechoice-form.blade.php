 @include('layouts/header')
 <!-- <link rel="stylesheet" href="{{URL::to('plugins/datatables/dataTables.bootstrap.css')}}"> -->

  <!-- Left side column. contains the logo and sidebar -->
  
  
  <link rel="stylesheet" href="{{URL::to('bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />

@include('layouts/teacher_nav')
<div class="content-wrapper">
    <section class="content">

      <div class="row">

        <div class="col-md-6">
                      @if(isset($value))
                        <?php $adaInput = 'true';?>
                        @foreach($value as $val) 
                          <?php
                          // $isiInput['name'] = $val->name;
                          $isiInput['qq_id'] = $val->id;
                          $isiInput['qq_question'] = $val->question;
                          $isiInput['q_id'] = $val->quiz_id;
                          $isiInput['q_order'] = $val->number_order;
                          $isiInput['is_essay'] = $val->is_essay;
                          $isiInput['qq_answer'] = $val->answer;
                          foreach ($val->choiches->where('quiz_question_id',$val->id) as $qm) {
                            // echo "<h3>Ams{$qm->answer1}</h3>";
                            // var_dump($qm);
                            $isiInput['qq_answer1'] = $qm->answer1;
                            $isiInput['qq_answer2'] = $qm->answer2;
                            $isiInput['qq_answer3'] = $qm->answer3;
                            $isiInput['qq_answer4'] = $qm->answer4;
                            // break;
                          }
                          
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
                  Update a question
                @else  
                  Create a question
                @endif
                </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
            </div>
            <div class="box-body">
              @if($adaInput=='true')
                <form action="../../../../quiz-multiplechoice-question/update" method="post">
                  <input type="hidden" name="qq_id" value="{{$isiInput['qq_id']}}">
              @else
                <form action="../../../quiz-multiplechoice-question" method="post">
              @endif
                {{ csrf_field() }}
            	<input type="hidden" name="is_essay" value="1">
                <input type="hidden" name="q_id" value="{{$q_id}}">
                <div class="form-group">
                  <b>Quiz Title: {{$quiz->title}}</b>
                </div>
                  <div class="form-group">
                    <label>Question:</label>
                    @if($adaInput=='true')
                      <input value="{{$isiInput['qq_question']}}" type="text" class="form-control" name="question">
                    @else
                      <input type="text" class="form-control" name="question">
                    @endif
                    
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label>Answer A</label>
                    <textarea name="answer1" class="form-control">@if($adaInput=='true'){{$isiInput['qq_answer1']}}@endif</textarea>
                    <!-- <input type="text" name="closed_time" class="form-control"> -->
                  </div>

                  <div class="form-group">
                    <label>Answer B</label>
                    <textarea name="answer2" class="form-control">@if($adaInput=='true'){{$isiInput['qq_answer2']}}@endif</textarea>
                    <!-- <input type="text" name="closed_time" class="form-control"> -->
                  </div>

                  <div class="form-group">
                    <label>Answer C</label>
                    <textarea name="answer3" class="form-control">@if($adaInput=='true'){{$isiInput['qq_answer3']}}@endif</textarea>
                    <!-- <input type="text" name="closed_time" class="form-control"> -->
                  </div>

                  <div class="form-group">
                    <label>Answer D</label>
                    <textarea name="answer4" class="form-control">@if($adaInput=='true'){{$isiInput['qq_answer4']}}@endif</textarea>
                    <!-- <input type="text" name="closed_time" class="form-control"> -->
                  </div>

                  <div class="form-group">
                    <label>True Answer</label>
                    <select name="answer" class="form-control">
                    	<?php 
                      $alphabet = range('A', 'Z');
                      for($i=0; $i<=3; $i++){ 
                    		if($adaInput=='true')
                    			// if ($answer==$i) 
                          if ($isiInput['qq_answer']==$alphabet[$i]) 
                    				echo '<option value="'.$alphabet[$i].'" selected>Answer '.$alphabet[$i].'</option>';
                    			else
                    				echo '<option value="'.$alphabet[$i].'" >Answer '.$alphabet[$i].'</option>';
                    		else
                    			echo '<option value="'.$alphabet[$i].'" >Answer '.$alphabet[$i].'</option>';
                    		?>
                    	<?php } ?>
                    </select>
                    <!-- <input type="text" name="closed_time" class="form-control"> -->
                  </div>
                  <!-- phone mask -->
                  @if($adaInput=='true')
                    <a href="../../../../quiz/manage-on-course/{{$q_id}}/{{$s_id}}/{{$c_id}}" class="btn btn-default">Back to session</a>
                    <input type="submit" class="btn btn-success" name="submit" value="Update" >
                  @else  
                    <a href="../../../quiz/manage-on-course/{{$q_id}}/{{$s_id}}/{{$c_id}}" class="btn btn-default">Cancel</a>
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