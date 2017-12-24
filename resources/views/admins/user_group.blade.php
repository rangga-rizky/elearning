 @include('layouts/header')
 @include('layouts/admin_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>User Groups
      </h1>
    </div>
    <button type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Create new Group</button>
  </section>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create new Group</h4>
        </div>
        <form method="POST" action="{{ url('admin/groups') }}">
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Create</button>
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

    <div class="row" style="margin-top: 10px">
      @foreach($groups as $group)
      <a href="{{ url('admin/user_groups/'.$group->id)}}">
      <div class="col-md-4">
        <div class="bg-blue" style="padding: 10px">
          <h3 class="widget-user-username">{{$group->name}}</h3>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li style="padding: 10px">{{ sizeof($group->user_groups)  }} Students registered </li>
           </ul>
        </div>

      </div>
      </a>
      @endforeach
    </div>


  </section>
  <!-- /.content -->
</div>



@include('layouts/footer')
