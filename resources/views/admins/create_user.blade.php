 @include('layouts/header')
 @include('layouts/admin_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header" >
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>Create User
      </h1>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
         <form class="form-horizontal" method="POST" action="{{ url('admin/user') }}">
    
        <br>

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control">Name</label>

        <div class="col-md-6">
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control">Password</label>

        <div class="col-md-6">
          <input id="password" type="password" class="form-control" name="password" required>

          @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="form-group">
        <label for="password-confirm" class="col-md-4 control">Confirm Password</label>

        <div class="col-md-6">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
      </div>

      <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
        <label for="role" class="col-md-4">User role</label>

        <div class="col-md-6">
          <select id="role" class="form-control" name="role" required>
            @foreach($roles as $id => $role)
            <option value="{{$id}}">{{$role}}</option>
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
            Register
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
