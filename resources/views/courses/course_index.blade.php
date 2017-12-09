 @include('layouts/header')
 @include('layouts/student_sidebar')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Courses Header -->
  <section class="content-header">
    <div class="header-section ">
        <h1>
            <i class="gi gi-book_open"></i>Courses Catalogue
        </h1>
    </div>
  </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
         <div class="col-md-8">           
           @foreach($courseCategories as $category)
              <a class="btn btn-default btn-sm" href="{{URL::to('courses/category/'.$category->id)}}" style="margin-top: -5px; border: 0px; box-shadow: none; color: #3c8dbc; font-weight: 600; background: rgb(255, 255, 255);">{{$category->name}}</a>
           @endforeach
         </div>        
      </div>
      <br>
      <div class="row">
          <?php $color = ['red','green','yellow','blue']  ?>
          @if(count($courses) > 0)
           @foreach($courses as $course)
        <div class="col-md-4">
          <div class="info-box">
         <!-- Apply any bg-* class to to the icon to color it -->
            <span class="info-box-icon bg-{{$color[rand(0,3)]}}"><i class="fa fa-star-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-number">{{ $course->title}}</span>              
              <span class="info-box-text"><strong>Author :</strong> {{ $course->user['username']}}</span><br>
              <span class="info-box-text">{{ $course->category['name']}}</span>
            </div>
        <!-- /.info-box-content -->
          </div>           
        </div>
         @endforeach
         @else
          <div class="panel panel-default">
            <div class="panel-body">Tidak ditemukan kursus!</div>
          </div>

         @endif
      </div>
      <div clas="row">
        <?php echo $courses->render(); ?>
      </div>

    </section>
    <!-- /.content -->
  </div>
  @include('layouts/footer')