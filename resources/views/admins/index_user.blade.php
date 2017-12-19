 @include('layouts/header')
 @include('layouts/admin_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>User
      </h1>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
  @if(session('success'))
    <div class="panel panel-success">
    <div class="panel-body">{{session('success')}}</div>
    </div>
  @endif
  <table class="table table-bordered" style="background: white">
    <thead>
      <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $value)

      <form class="form-horizontal" method="POST" action="{{ url('admin/user/delete') }}">
      <tr>
        <td>{{$value->id}}</td>
        <td>{{$value->username}}</td>
        <td>{{$value->email}}</td>
        <td>{{$value->role->name}}</td>
        <td>
          <a href="{{url('admin/user/'.$value->id)}}" class="btn btn-primary">Edit</a>
            <input type="hidden" name="id" value="{{$value->id}}">
            <button type="submit" class="btn btn-danger">Delete</button>
          
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
