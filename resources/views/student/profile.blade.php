 @include('layouts/header')
 @include('layouts/student_sidebar')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Courses Header -->
  <section class="content-header">
    <div class="header-section ">
        <h1>
            <i class="gi gi-book_open"></i>My Profile
        </h1>
    </div>
  </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{$user->username}}</h3>
              <h5 class="widget-user-desc">{{$user->role->name}}</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $grades->count() }}</h5>
                    <span class="description-text">COURSE FINISHED</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$number_finished_assignment}}</h5>
                    <span class="description-text">ASSIGNMENT FINISHED</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">{{$number_finished_quiz}}</h5>
                    <span class="description-text">QUIZ FINISHED</span>
                  </div>
                  <!-- /.description-block -->
                </div>


                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <div class="bg-yellow" style="padding: 10px">
              <h3 class="widget-user-username">Current Active Groups</h3>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                @foreach($user->userGroups as $group)
                  <li style="padding: 10px">{{ $group->group->name }} </li>
                @endforeach
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
          
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Performance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Course</th>
                  <th>Teacher</th>
                  <th>Group</th>
                  <th style="width: 40px">Grade</th>
                </tr>                
                  @for($i=0 ; $i < sizeof($grades) ; $i++)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{$grades[$i]->course->title }}</td>
                  <td>
                    {{$grades[$i]->teacher->username }}
                  </td>
                  <td>
                    {{$grades[$i]->group->name }}
                  </td>
                  @if(in_array($grades[$i]->value,["A","AB","B","BC"]))
                    <td><span class="badge bg-green">{{$grades[$i]->value}}</span></td>      
                  @elseif($grades[$i]->value == "C")          
                    <td><span class="badge bg-yellow">{{$grades[$i]->value}}</span></td>  
                  @else
                    <td><span class="badge bg-red">{{$grades[$i]->value}}</span></td> 
                  @endif
                </tr>
                 @endfor
               
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-header" style="float: right;">
              <a href="{{url('user/pdf')}}" class="btn btn-primary ">Print</a>
            </div>
          </div>
          <!-- /.box -->
        </div>
          
        </div>

        </div>


    </section>
    <!-- /.content -->
  </div>
  @include('layouts/footer')