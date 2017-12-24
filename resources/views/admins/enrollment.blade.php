 @include('layouts/header')
 @include('layouts/admin_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>Courses Enrollment
      </h1>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">

     @if(session('success'))
    <div class="panel panel-success">
    <div class="panel-body">{{session('success')}}</div>
    </div>
    @endif

    <div class="row" style="margin-top: 10px">
      @foreach($courses as $course)
      <a href="{{url('admin/enrollments/'.$course->id)}}">
         <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">{{$course->title}}</span>
              <span class="info-box-text">{{ sizeof($course->enrollments)  }} Group enroll in this course</span>
              <span class="info-box-text">Owner : {{ $course->user->username  }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

      </a>
      @endforeach
    </div>


  </section>
  <!-- /.content -->
</div>



@include('layouts/footer')
