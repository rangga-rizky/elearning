<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('home');
});

Auth::routes();
Route::get('/dashboard', 'DashboardController@index');//dashboard untuk user dan teacher

//courses
Route::post('courses', 'CourseController@store_teacher'); // buat kursus oleh teacher
Route::get('/courses/student', 'CourseController@indexStudent'); //course catalog untuk student
Route::get('/courses/category/{category_id}', 'CourseController@showByCategory'); //course catalog by category untuk student
Route::get('courses/delete/{id}', [ 'as' => 'courses/delete_teacher/{id}',
									'uses' => 'CourseController@delete_teacher']);
Route::get('courses/edit/{id}', [ 'as' => 'courses/edit/{id}', 
								 'uses' => 'CourseController@edit_teacher']);// menampilkan halaman edit kursus
Route::get('/courses/{id}', 'CourseController@show')->middleware('can:show-course,id');;// menampilkan halamn kursus by id

//student-assignment
Route::post('/student_assignment', 'StudentAssignmentController@store'); //mengumpulkan tugas oleh student owner student assignment

//assignment
Route::get('/assignment/student/{assignment_id}', 'AssignmentController@showbyUser');//menampilkan halaman tugas oleh student anggota kursus

//session
Route::get('/sessions/teacher', 'SessionController@indexByAuthor'); // menampilkan semua session untuk teacher owner kursus
Route::get('/sessions/courses/{id}', 'SessionController@showByCourse'); // menampilkan session by id kursus untuk teacher owner kursus


//quiz
Route::get('/quiz/student/start/{quiz_id}', 'QuizController@startQuiz'); //mulai kuis hanya untuk member kursus dan belum pernah mulai
Route::get('/quiz/student/{quiz_id}', 'QuizController@showForUser'); //menampilan halaman quiz untuk student member kursus

//student answer
Route::post('/student_answer', 'QuizStudentAnswerController@store'); 

//user
Route::get('/user', 'UserController@show');


Route::prefix('admin')->namespace('Admin')->middleware('can:admin-only')->group(function () {
   Route::get('/dashboard', 'DashboardController@index');
   Route::get('/user/create', 'UserController@create');
   Route::get('/user', 'UserController@index');
   Route::get('/user/{id}', 'UserController@show');
   Route::post('/user', 'UserController@store');
   Route::post('/user/update', 'UserController@update');
   Route::post('/user/delete', 'UserController@remove');
   Route::post('/user/reset_password', 'UserController@reset_password');
});