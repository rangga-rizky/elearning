 @include('layouts/header')
 @include('layouts/admin_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>{{$userGroups[0]->group->name}}
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
        <form method="POST" action="{{ url('admin/user_groups') }}">
          <div class="modal-body">
            <div class="form-group">

              @foreach($users as $data)
              <div class="checkbox">
                <label><input type="checkbox" name="user_id[]" value="{{$data->id}}">{{$data->username}} ({{$data->email}})</label>
              </div>

              @endforeach
              <input type="hidden" name="group_id" value="{{$userGroups[0]->group->id}}">
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


  @if ($errors->has('user_id'))
  <span class="help-block" style="color: red;">
    <strong>you need choose minimum one user </strong>
  </span>
  @endif

  <table class="table table-bordered" style="background: white">
    <thead>
      <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($userGroups as $userGroup)

      <form class="form-horizontal" method="POST" action="{{ url('admin/user_groups/delete') }}">
        <tr>
          <td>{{$userGroup->user->id}}</td>
          <td>{{$userGroup->user->username}}</td>
          <td>{{$userGroup->user->email}}</td>
          <td>
            <input type="hidden" value="{{$userGroup->id}}" name="id">
             <input type="hidden" value="{{$userGroup->group_id}}" name="group_id">
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
