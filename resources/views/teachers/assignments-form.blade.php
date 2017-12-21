 @include('layouts/header')
 <link rel="stylesheet" href="{{URL::to('plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Left side column. contains the logo and sidebar -->
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
                  $isiInput['s_id'] = $val->s_id;
                  $isiInput['s_title'] = $val->s_title;
                  $isiInput['c_id'] = $val->c_id;
                  
                  $isiInput['description'] = $val->description;
                  ?>
                @endforeach
              @else
                <?php $adaInput = 'false';?>
              @endif
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title">
        @if($adaInput=='true')
          Update a session
        @else  
          Create a session
        @endif
        </h3>

            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
    </div>
    <div class="box-body">
      <!-- Date dd/mm/yyyy -->
      @if($adaInput=='true')
        <form action="../../sessions/update" method="post">
          <input type="hidden" name="s_id" value="{{$isiInput['s_id']}}">
      @else
        <form action="../../sessions" method="post">
      @endif
      {{ csrf_field() }}
          <div class="form-group">
            <label>Course name:</label>
            @if(isset($course_id))
                <input type="hidden" name="course" value="{{$course_id}}">
                <select class="form-control select2" style="width: 100%;"  autocomplete="off" disabled>
            @else
                <select class="form-control select2" style="width: 100%;" name="course"  autocomplete="off" >
            @endif
              @if($adaInput=='true')
                  @foreach($courses as $c)      
                    @if($isiInput['c_id'] == $c->c_id)
                      <option value="{{ $c->c_id }}" selected>{{ $c->c_title }}</option>
                    @else
                      <option value="{{ $c->c_id }}">{{ $c->c_title }}</option>
                    @endif
                  @endforeach

              @elseif(isset($course_id))
                @foreach($courses as $c)      
                  @if($course_id == $c->c_id)
                    <option selected="selected" value="{{ $c->c_id }}">{{ $c->c_title }}</option>
                  @else
                    <option value="{{ $c->c_id }}">{{ $c->c_title }}</option>
                  @endif
                @endforeach
              @else
                @foreach($courses as $c)      
                  <option value="{{ $c->c_id }}">{{ $c->c_title }}</option>
                @endforeach
              @endif
            </select>
          </div><!-- /.form group -->
          <div class="form-group">
            <label>Session name:</label>
            @if($adaInput=='true')
              <input value="{{$isiInput['s_title']}}" type="text" class="form-control" name="title">
            @else
              <input type="text" class="form-control" name="title">
            @endif
            
          </div>
          <!-- phone mask -->
          <div class="form-group">
            <label>Short description:</label>
            
              <textarea class="form-control" rows="3" name="description" placeholder="Enter ..." style="margin: 0px 103.5px 0px 0px; height: 51px; width: 100%;">@if($adaInput=='true'){{$isiInput['description']}}@endif</textarea>
            
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