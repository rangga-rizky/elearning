 @include('layouts/header')
 @include('layouts/teacher_nav')
 <div class="content-wrapper">
    <section class="content">

      <div class="row">

<div class="col-md-7">
              @if(isset($value))
                <?php $adaInput = 'true'?>
                @foreach($value as $val) 
                  <?php
                  $isiInput['l_id'] = $val->id;
                  $isiInput['s_id'] = $val->session_id;
                  $isiInput['text'] = $val->text;
                  $isiInput['filepath'] = $val->filepath;
                  $isiInput['modul_type'] = $val->modul_type;
                  ?>
                @endforeach
              @else
                <?php $adaInput = 'false'?>
              @endif
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title">
        @if($adaInput=='true')
          Update a lesson
        @else  
          Create a lesson 
        @endif
        </h3>

            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
    </div>
    <div class="box-body">
      <!-- Date dd/mm/yyyy -->
      @if($adaInput=='true')
        <form action="../../../lessons/update" method="post" enctype="multipart/form-data">
          <input type="hidden" name="l_id" value="{{$isiInput['l_id']}}">
      @else
        <form action="../../../lessons" method="post" enctype="multipart/form-data">
      @endif
        {{ csrf_field() }}
        <input type="hidden" name="s_id" value="{{$s_id}}">
        <input type="hidden" name="c_id" value="{{$course->id}}">
        <div class="form-group">
          <b>Course Name: {{$course->title}}</b><br>
          <b>Session Name: {{$session->title}}</b>
        </div>
          <!-- <div class="form-group">
            <label></label>
          </div>
          <div class="form-group">
            <label>Session Name: {{$session->title}}</label> -->
            <!-- <select class="form-control select2" style="width: 100%;" name="session">
              <?php 
              /*if($adaInput=='true')
                  foreach($session as $c){
                    if($isiInput['s_id'] == $c->id)
                      <option selected value="{{ $c->id }}">{{ $c->title }}</option>
                    else
                      <option value="{{ $c->id }}">{{ $c->title }}</option>
                    
                  }

              else
                foreach($session as $c){
                    if($s_id == $c->id)
                      <option selected value="{{ $c->id }}">{{ $c->title }}</option>
                    else
                      <option value="{{ $c->id }}">{{ $c->title }}</option>
                
                }
              */
              ?>
            </select> 
          </div>-->
          <!-- /.form-group -->
          <div class="form-group">
            <label>Lesson name:</label>
            @if($adaInput=='true')
              <input value="{{$isiInput['text']}}" type="text" class="form-control" name="text">
            @else
              <input type="text" class="form-control" name="text">
            @endif
            
          </div><!-- /.form group -->
          <div class="form-group">
            <label>Modul type </label>
            <select class="form-control select2" style="width: 100%;" name="modul_type">
                @if($adaInput=='true')
                  @if($isiInput['modul_type'] =='praktikum')
                    <option selected value="praktikum">Practice</option>
                    <option value="teori">Theory</option>
                  @else
                    <option value="praktikum">Practice</option>
                    <option selected value="teori">Theory</option>
                  @endif
                @else
                    <option value="praktikum">Practice</option>
                    <option value="teori">Theory</option>
                @endif
            </select>
          </div>
          <!-- phone mask -->
          <div class="form-group">
            <label>Last uploaded file :</label>
              @if($adaInput=='true')
                <br><a target="_blank" href="{{url($isiInput['filepath'] )}}">{{$isiInput['text'] }} </a>
                <br>
                <label>Upload new file to replace :</label>
                <input type="file" name="fileupload" class="form-control" >
              @else
                <input type="file" name="fileupload" class="form-control" >
              @endif
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