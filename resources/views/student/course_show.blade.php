 @include('layouts/header')
 @include('layouts/student_sidebar')



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

      @if(count($course->sessions) > 0)
      @foreach($course->sessions as $session)
      <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <h3>{{ $session->title }}</h3>
              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Deskripsi</strong>
              <p>{{ $session->description }}</p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> Modul Teori</strong>
              <ul> 
              @foreach($session->lessons->where('modul_type',"teori") as $lesson)
                <li><a href="{{url($lesson->filepath)}}">{{$lesson->text}} </a></li> 

              @endforeach
              </ul>
              
              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Modul Praktikum</strong>
              <ul>
                @foreach($session->lessons->where('modul_type',"praktikum") as $lesson)
                  <li><a href="{{url($lesson->filepath)}}">{{$lesson->text}} </a></li> 

              @endforeach
              </ul>

              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> Upload Tugas</strong>
              @foreach($session->assignments as $assignment)
                <p><a href="{{ url('assignment/student/'.$assignment->id) }}">{{$assignment->title}}</a></p>
              @endforeach


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