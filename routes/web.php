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
Route::get('/courses/{id}', 'CourseController@show');// menampilkan halamn kursus by id

//student-assignment
Route::post('/student_assignment', 'StudentAssignmentController@store'); //mengumpulkan tugas oleh student owner student assignment

//assignment
Route::get('/assignment/student/{id}', 'AssignmentController@showbyUser');//menampilkan halaman tugas oleh student anggota kursus

//session
Route::get('/sessions/teacher', 'SessionController@indexByAuthor'); // menampilkan semua session untuk teacher owner kursus
Route::get('/sessions/courses/{id}', 'SessionController@showByCourse'); // menampilkan session by id kursus untuk teacher owner kursus


