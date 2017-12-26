 @include('layouts/header')
 @include('layouts/student_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header">
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>{{ $assignment->title }}
      </h1>
      <h5>{{ $assignment->description }}</h5>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="box">
      <div class="box-header">
        <h4>Submission Status</h4>
      </div>

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Submission status</td>
            @if(is_null($studentAssingment))
            <td>Not Submitted</td>
            @else
            <td>{{$studentAssingment["status"] }}</td>
            @endif
          </tr>
          <tr>
            <td>Grading status</td>
            <td>Not graded</td>
          </tr>
          <tr>
            <td>Due date</td>
            <td>{{$assignment["closed_time"] }}</td>
          </tr>
          <tr>
            <td>Time Remaining</td>
            <td>{{ $assignment["remaining"] }}</td>
          </tr>
          <tr>
            <td>Last modified</td>
            @if(is_null($studentAssingment))
            <td>-</td>
            @else
            <td>{{$studentAssingment["last_updated"] }}</td>
            @endif
          </tr>
          @if(!is_null($studentAssingment))
          <tr>
            <td></td>
            <td> <a href="{{ url($studentAssingment['file_path']) }}"><strong><i class="fa fa-file-pdf-o margin-r-5"></i> your submitted file</strong></td></a>
          </tr>
          @endif
          <form method="POST" action="{{ url('student_assignment') }}" enctype="multipart/form-data">
            <tr>
              <td><input type="hidden" name="assignment_id" value="{{ $assignment['id']}}"></td>
              <td><input type="file" name="file"></td>
            </tr>
            <tr>
              <td></td>
              <td>
                <button type="submit" class="btn btn-primary">
                @if(is_null($studentAssingment))
                  Submit
                @else
                  Update Submit
                @endif
               </button>  
              </td>
            </tr>
          </form>
        </tbody>
      </table>
    </div>
  </section>
  <!-- /.content -->
</div>
@include('layouts/footer')