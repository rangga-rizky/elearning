  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ $user->username }}</p>
        </div>
      </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="{{URL::to('admin/dashboard')}}">
            <i class="fa fa-th"></i> <span>Home</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('admin/user/create')}}"><i class="fa fa-circle-o"></i> Create User</a></li>
            <li><a href="{{URL::to('admin/user')}}"><i class="fa fa-circle-o"></i> Edit User</a></li>
          </ul>
        </li>
         <li class="">
          <a href="{{URL::to('admin/user_groups')}}">
            <i class="fa fa-laptop"></i>
            <span>User Groups Management</span>

          </a>
        </li>
        <li class="">
          <a href="{{URL::to('admin/enrollments')}}">
            <i class="fa fa-book"></i>
            <span>Enrollment Management</span>

          </a>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>