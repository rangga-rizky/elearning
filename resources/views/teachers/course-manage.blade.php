 @include('layouts/header')
 @include('layouts/teacher_nav')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Courses Header -->
  <section class="content-header">
    <div class="header-section ">
        <h1>
            <i class="gi gi-book_open"></i>{{$course->title}}
        </h1>
        <small>{{$course->description}}</small>
    </div>
  </section>

   <section class="content">
      <a class="btn btn-primary" href="../../sessions/create-on-course/{{$course->id}}"><i class="fa fa-plus"></i> Create a session</a>
      <br><br>
      @if(count($course->sessions) > 0)
      @foreach($course->sessions as $session)
      <div class="row">
        <div class="col-md-7">
        <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <h3 class="">{{ $session->title }}</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="../../sessions/edit/{{$session->id}}"><i class="fa fa-pencil"></i> Edit this session</a></li>
                        <li><a class="manage-btn" onclick="manage_session({{$session->id}}, this)" href="#{{$session->id}}"><i class="fa fa-gear"></i> Manage this session</a></li>
                        <li><a href="../../sessions/delete/{{$session->id}}/{{$course->id}}"><i class="fa fa-trash"></i> Delete this session</a></li>
                        <li class="divider"></li>
                        <li><a href="../../lessons/create-on-course/{{$session->id}}/{{$course->id}}"><i class="fa fa-sticky-note"></i> Add lesson on this session</a></li>
                        <li><a href="../../quiz/create-on-course/{{$session->id}}/{{$course->id}}"><i class="fa fa-cubes"></i> Add quiz on this session</a></li>
                        <li><a href="../../assignments/create-on-course/{{$session->id}}/{{$course->id}}"><i class="fa fa-upload"></i> Add assignment on this session</a></li>
                      </ul>
                    </div>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Deskripsi</strong>
              <p>{{ $session->description }}</p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> Modul Teori</strong>
              <ul> 
              @foreach($session->lessons->where('modul_type',"teori") as $lesson)
                <li>
                  <a href="{{url($lesson->filepath)}}">{{$lesson->text}} </a> 
                  <span class="manage-session-{{$lesson->session_id}}" style="display: none;">
                    <a class="btn btn-xs btn-warning" href="../../lessons/update-on-course/{{$lesson->id}}/{{$lesson->session_id}}/{{$course->id}}"><i class="fa fa-pencil"></i></a>

  <!--                   <a class="btn btn-xs btn-warning" href="../../lessons/edit/{{$lesson->id}}"><i class="fa fa-pencil"></i></a> -->
                    <a class="btn btn-xs btn-danger" href="../../lessons/delete/{{$lesson->id}}"><i class="fa fa-trash"></i></a>
                  </span>
                </li> 

              @endforeach
              </ul>
              
              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Modul Praktikum</strong>
              <ul>
                @foreach($session->lessons->where('modul_type',"praktikum") as $lesson)
                  <li>
                    <a href="{{url($lesson->filepath)}}">{{$lesson->text}} </a>
                    <span class="manage-session-{{$lesson->session_id}}" style="display: none;">
                      <a class="btn btn-xs btn-warning" href="../../lessons/update-on-course/{{$lesson->id}}/{{$lesson->session_id}}/{{$course->id}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-xs btn-danger" href="../../lessons/delete/{{$lesson->id}}"><i class="fa fa-trash"></i></a>
                    </span>
                  </li>
                @endforeach
              </ul>

              <hr>

              <strong><i class="fa fa-cubes margin-r-5"></i> Quiz</strong>
              <ul>
                <?php $i=1; ?>
                @foreach($session->quizes as $quiz)
                  <li>
                    Quiz {{$i}} 
                    <span class="manage-session-{{$quiz->session_id}}" style="display: none;">
                      <a class="btn btn-xs btn-warning" href="../../quiz/manage-on-course/{{$quiz->id}}/{{$quiz->session_id}}/{{$course->id}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-xs btn-danger" href="../../quiz/delete/{{$quiz->id}}"><i class="fa fa-trash"></i></a>
                    </span>
                  </li>
                  <?php  $i++;?>
                @endforeach
              </ul>

              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> Tugas</strong>
              <ul>
              @foreach($session->assignments as $assignment)
                <li>
                    {{$assignment->title}}
                    <span class="manage-session-{{$assignment->session_id}}" style="display: none;">
                      <a class="btn btn-xs btn-warning" href="../../assignments/update-on-course/{{$assignment->id}}/{{$lesson->session_id}}/{{$course->id}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-xs btn-danger" href="../../assignments/delete/{{$assignment->id}}/{{$lesson->session_id}}/{{$course->id}}"><i class="fa fa-trash"></i></a>
                    </span>
                  </li>
              @endforeach
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
        @endforeach
         @else
          <div class="panel panel-default">
            <div class="panel-body">Belum ada Session pada kursus ini</div>
          </div>

         @endif
    </section>
    <!-- /.content -->
  </div>
  @include('layouts/footer')

  <script type="text/javascript">
    function manage_session(s, element) {
      var str = element.innerHTML;
      if(str == '<i class="fa fa-gear"></i> Finish manage this session')
        element.innerHTML = '<i class="fa fa-gear"></i> Manage this session'
      else
        element.innerHTML = '<i class="fa fa-gear"></i> Finish manage this session'
      // console.log(str);
      var sid = s;
      $('.manage-session-'+sid).toggle();
    }
  </script>