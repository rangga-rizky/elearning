 @include('layouts/header')
 @include('layouts/admin_sidebar')



 <!-- Content Wrapper. Contains page content -->
 <div id="fullCalModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        <h4 id="modalTitle" class="modal-title">Event</h4>
      </div>
      <div id="modalBody" class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" id="eventUrl" target="_blank">Event Page</a>
      </div>
    </div>
  </div>
</div>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>Welcome to <strong>Elearning Laravel</strong><br>
      </h1>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $number_of_students}}</h3>

          <p>Student Registered</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3>{{$number_of_teachers}}</h3>

          <p>Teacher Registered</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$number_of_courses}}</h3>

              <p>Courses Created</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>


  </section>
  <!-- /.content -->
</div>



@include('layouts/footer')
