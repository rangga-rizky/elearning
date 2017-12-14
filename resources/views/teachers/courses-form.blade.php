<div class="col-md-7">
              @if(isset($value))
                <?php $adaInput = 'true'?>
                @foreach($value as $val) 
                  <?php
                  $isiInput['name'] = $val->name;
                  $isiInput['c_id'] = $val->c_id;
                  $isiInput['cc_id'] = $val->cc_id;
                  $isiInput['title'] = $val->title;
                  $isiInput['description'] = $val->description;
                  ?>
                @endforeach
              @else
                <?php $adaInput = 'false'?>
              @endif
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title">
        @if($adaInput=='true')
          Update a course
        @else  
          Create a course
        @endif
        </h3>

            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
    </div>
    <div class="box-body">
      <!-- Date dd/mm/yyyy -->
      @if($adaInput=='true')
        <form action="update_teacher" method="post">
          <input type="hidden" name="c_id" value="{{$isiInput['c_id']}}">
      @else
        <form action="courses" method="post">
      @endif
          <div class="form-group">
            <label>Course category</label>
            <select class="form-control select2" style="width: 100%;" name="course_category">
              

              @if($adaInput=='true')
                  @foreach($course_cat as $cc)      
                    @if($isiInput['name'] == $cc->name)
                      <option selected value="{{ $cc->id }}">{{ $cc->name }}</option>
                    @else
                      <option value="{{ $cc->id }}">{{ $cc->name }}</option>
                    @endif
                  @endforeach

              @else
                @foreach($course_cat as $cc)      
                  <option value="{{ $cc->id }}">{{ $cc->name }}</option>
                @endforeach
              @endif
            </select>
          </div><!-- /.form-group -->
          <div class="form-group">
            <label>Course name:</label>
            @if($adaInput=='true')
              <input value="{{$isiInput['title']}}" type="text" class="form-control" name="title">
            @else
              <input type="text" class="form-control" name="title">
            @endif
            
          </div><!-- /.form group -->

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