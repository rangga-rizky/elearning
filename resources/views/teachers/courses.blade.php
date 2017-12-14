 @include('layouts/header')
 <link rel="stylesheet" href="{{URL::to('plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Left side column. contains the logo and sidebar -->
@include('layouts/teacher_nav')
<div class="content-wrapper">
    <section class="content">

      <div class="row">
      	@include('teachers/courses-form')
        <!-- /.col (left) -->
        <div class="col-md-12">
	      <div class="box box-default">
	        <div class="box-header with-border">
	          <h3 class="box-title">Courses</h3>
	          <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
	          </div>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          
	          <table id="example2" class="table table-bordered table-hover">
	                    <thead>
	                      <tr>
	                      	<th>Course category</th>
	                        <th>Course name</th>
	                        <th>Desciption</th>
	                        <th>Action</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($courses as $c)

	                      <tr>
	                      	<td>{{ $c->name }}</td>
	                        <td>{{ $c->title }}</td>
	                        <td>
	                          {{ $c->description }}</td>
	                        <td>
	                        	<a href="courses/edit/{{$c->c_id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
	                        	<a href="courses/delete/{{$c->c_id}}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
	                        	<a href="courses/enrollment/{{$c->c_id}}" class="btn btn-primary"><i class="fa fa-users"></i> Enrollment</a>
	                        	<a href="sessions/courses/{{$c->c_id}}" class="btn btn-primary"><i class="fa fa-time"></i> Session</a>
	                        </td>
	                      </tr>
	                    @endforeach

	                    </tbody>
	                    <tfoot>
	                      <tr>
	                        <th>Course name</th>
	                        <th>Desciption</th>
	                        <th>Action</th>
	                      </tr>
	                    </tfoot>
	                  </table>
	          
	        </div><!-- /.box-body -->
	        <div class="box-footer">
	          
	        </div>
	      </div><!-- /.box -->

	  </div><!-- col-md-12-->
        
      </div><!-- /.row -->

    </section><!-- /.content -->
</div>
  @include('layouts/footer')

  <script src="{{URL::to('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::to('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script>
      $(function () {
        // $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>