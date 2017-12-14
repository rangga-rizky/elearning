 @include('layouts/header')
 <link rel="stylesheet" href="{{URL::to('plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Left side column. contains the logo and sidebar -->
@include('layouts/teacher_nav')
<div class="content-wrapper">
    <section class="content">

      <div class="row">
        
        <!-- /.col (left) -->
        <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Sessions</h3>
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
                          <th>Session name</th>
                          <th>Desciption</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($sessions as $c)

                        <tr>
                          <td>{{ $c->name }}</td>
                          <td>{{ $c->c_title }}</td>
                          <td>{{ $c->title }}</td>
                          <td>{{ $c->description }}</td>
                          <td>
                            <a href="sessions/edit/{{$c->s_id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="sessions/delete/{{$c->s_id}}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            <a href="sessions/lessons/{{$c->s_id}}" class="btn btn-primary"><i class="fa fa-book"></i> Lessons</a>
                            <a href="sessions/assignments/{{$c->s_id}}" class="btn btn-primary"><i class="fa fa-book-alt"></i> Assignment</a>
                          </td>
                        </tr>
                      @endforeach

                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Course category</th>
                          <th>Course name</th>
                          <th>Session name</th>
                          <th>Desciption</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
            
          </div><!-- /.box-body -->
          <div class="box-footer">
            
          </div>
        </div><!-- /.box -->

    </div>
        
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
          // "paging": true,
          // "lengthChange": false,
          // "searching": false,
          // "ordering": true,
          // "info": true,
          // "autoWidth": false
        });
      });
    </script>