 @include('layouts/header')
 @include('layouts/student_sidebar')


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Courses Header -->
  <section class="content-header">
    <div class="header-section ">
      <h1>
        <i class="gi gi-book_open"></i>{{ $quiz->title }}
      </h1>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="box">
      <div class="box-header">
        <h4>Quiz Status</h4>
      </div>

      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Quiz status</td>
            @if(is_null($quizEnrollments))
            <td>Has not Taken</td>
            @else
            <td>Already Taken</td>
            @endif
          </tr>
          <tr>
            <td>Grading status</td>
            <td>Not graded</td>
          </tr>
          <tr>
            <td>Due date</td>
            <td>{{$quiz["closed_time"] }}</td>
          </tr>
          <tr>
            <td>Time Remaining</td>
            <td>{{ $quiz["remaining"] }}</td>
          </tr>
          @if(is_null($quizEnrollments))
            <tr>
              <td></td>
              <td>
                @if($is_opened)
                <a href="{{url('quiz/student/start/'.$quiz['id'])}}" class="btn btn-primary">
                  Start Quiz
               </a> 
               @else
                <a href="" class="btn btn-danger">
                  Quiz Closed
               </a> 

               @endif

              </td>
            </tr>
          @endif
          
        </tbody>
      </table>
    </div>
  </section>
  <!-- /.content -->
</div>
@include('layouts/footer')