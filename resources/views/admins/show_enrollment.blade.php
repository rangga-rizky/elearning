 @include('layouts/header')
 @include('layouts/admin_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>{{$course->title}}
      </h1>
    </div>
    <button type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Add Member</button>
  </section>


   <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Member</h4>
        </div>
        <form method="POST" action="{{ url('admin/enrollments') }}">
          <div class="modal-body">
            <div class="form-group">

              @foreach($groups as $data)
              <div class="checkbox">
                <label><input type="checkbox" name="group_id[]" value="{{$data->id}}">{{$data->name}}</label>
              </div>

              @endforeach
              <input type="hidden" name="course_id" value="{{$course->id}}">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

        </form>
      </div>

    </div>
  </div>


  <!-- Main content -->
  <section class="content">

   @if(session('success'))
   <div class="panel panel-success">
    <div class="panel-body">{{session('success')}}</div>
  </div>
  @endif


  @if ($errors->has('group_id'))
  <span class="help-block" style="color: red;">
    <strong>you need choose minimum one group </strong>
  </span>
  @endif

  <table class="table table-bordered" style="background: white">
    <thead>
      <tr>
        <th>Id</th>
        <th>group name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($course->enrollments as $enrollment)

      <form class="form-horizontal" method="POST" action="{{ url('admin/enrollments/delete') }}">
        <tr>
          <td>{{$enrollment->id}}</td>
          <td>{{$enrollment->group->name}}</td>
          <td>
            <input type="hidden" value="{{$enrollment->id}}" name="id">
             <input type="hidden" value="{{$course->id}}" name="course_id">
            <button type="submit" class="btn btn-danger">Remove</button>
          </td>
        </tr>
      </form>
      @endforeach
    </tbody>
  </table>


</section>
<!-- /.content -->
</div>



@include('layouts/footer')
