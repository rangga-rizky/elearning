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
        <table class="table table-striped">
        <tbody>
          <tr>
            <td>Submission status</td>
            @if(!empty($studentAssingment))
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
            <td>Friday, 15 December 2017, 11:00 PM</td>
          </tr>
          <form method="POST" enc>
          <tr>
            <td><input type="hidden" name="assignment_id" value="{{ $assignment['id']}}"></td>
            <td><input type="file" name="file"></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <button type="button" class="btn btn-primary">Submit</button>  
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