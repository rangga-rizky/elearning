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
        <i class="gi gi-book_open"></i>Welcome to <strong>Elearning Laravel</strong><br><small>COK !</small>
      </h1>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->

   

</section>
<!-- /.content -->
</div>



@include('layouts/footer')
