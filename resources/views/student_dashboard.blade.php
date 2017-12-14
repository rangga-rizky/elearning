 @include('layouts/header')
 @include('layouts/student_sidebar')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Courses Header -->
  <section class="content-header">
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
      <div class="row">
          <?php $color = ['red','green','yellow','blue']  ?>
          @if(count($courses) > 0)
           @foreach($courses as $course)
        <div class="col-md-4">
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
            <div class="panel-body">Anda Belum Enroll pada Kursus apapun! buka <a href="{{URL::to(courses)}}">Katalog</a></div>
          </div>

         @endif
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  @include('layouts/footer')