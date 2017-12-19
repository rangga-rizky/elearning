 @include('layouts/header')
 @include('layouts/admin_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>Edit User
      </h1>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
         <form class="form-horizontal" method="POST" action="{{ url('admin/user/update') }}">
          <input type="hidden" name="id" value="{{$user_data->id}}">
    
        <br>

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control">Name</label>

        <div class="col-md-6">
          <input id="name" type="text" class="form-control" name="name" value="{{ $user_data->username }}" required autofocus>

          @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control">E-Mail Address</label>

        <div class="col-md-6">
          <input id="email" type="email" class="form-control" name="email" value="{{ $user_data->email }}" required>

          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
      </div>

    

      <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
        <label for="role" class="col-md-4">User role</label>

        <div class="col-md-6">
          <select id="role" class="form-control" name="role" required>
            @foreach($roles as $id => $role)
              @if($id == $user_data->role_id)
               <option value="{{$id}}">{{$role}}</option>
              @else
                <option value="{{$id}}">{{$role}}</option>
              @endif
            @endforeach
          </select>

          @if ($errors->has('role'))
          <span class="help-block">
            <strong>{{ $errors->first('role') }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-primary">
            Update
          </button>
        </div>
      </div>
    </form>
    <form class="form-horizontal" method="POST" action="{{ url('admin/user/reset_password') }}">
      <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
          <input type="hidden" name="id" value="{{$user_data->id}}">
          <button type="submit" class="btn btn-danger">
            Reset Password
          </button>
        </div>
      </div>
    </form>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>



@include('layouts/footer')
