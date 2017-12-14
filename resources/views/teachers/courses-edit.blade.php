 @include('layouts/header')
 <link rel="stylesheet" href="{{URL::to('plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Left side column. contains the logo and sidebar -->
@include('layouts/teacher_nav')
<div class="content-wrapper">
    <section class="content">

      <div class="row">
      	@include('teachers/courses-form')
        <!-- /.col (left) -->        
      </div><!-- /.row -->

    </section><!-- /.content -->
</div>
  @include('layouts/footer')