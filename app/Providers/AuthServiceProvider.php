<?php

namespace App\Providers;
use App\Enrollment;
use App\Quiz;
use App\QuizEnrollment;
use App\Course;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerQuizPolicies();
        $this->registerCoursePolicies();
        $this->registerAdminPolicies();
        //
    }

    public function registerQuizPolicies()
    {    
        Gate::define('start-quiz', function ($user , $quiz_id) {
            $groupsIds = $user->getGroupsIds();
            $quiz = Quiz::find($quiz_id);
            //cek apakah member kursus
            $enrollments = Enrollment::whereIn('group_id',$groupsIds)->where('course_id',$quiz->session->course["id"])->first();
            //cek apakah sudah enroll quiz
            $quizEnrollment = QuizEnrollment::where(["user_id" => $user->id,
                                                    "quiz_id" => $quiz_id])->first();
            return (!empty($enrollments)  && empty($quizEnrollment));
        });

    }

    public function registerCoursePolicies()
    {    
        Gate::define('show-course', function ($user , $course_id) {
            $groupsIds = $user->getGroupsIds();
            $course = Course::find($course_id);
            $enrollments = Enrollment::whereIn('group_id',$groupsIds)->where('course_id',$course_id)->first();

            return (!empty($enrollments)  || ($course["user_id"] == $user->id));
        });

    }

     public function registerAdminPolicies()
    {    
        Gate::define('admin-only', function ($user) {
            return ($user->role_id == 3);
        });

    }
}
