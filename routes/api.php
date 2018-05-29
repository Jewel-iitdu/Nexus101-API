<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::middleware('auth:api')->post('/user', function (Request $request){
//    return $request->user();
//});

Auth::routes();
Route::group(['middleware' => ['api','cors']], function () {
    Route::post('register', 'Auth\RegisterController@create');
});

Route::group(['middleware' => ['api','cors']], function () {
    Route::get('login', 'Auth\LoginController@login');
    Route::post('login', 'Auth\LoginController@login');
});

Route::post('/user/login', 'UserController@login');
Route::post('/student/store','StudentController@store');
Route::get('/student/show/{id}','StudentController@show');
Route::get('/students','StudentController@index');
Route::post('/student/update','StudentController@update');

Route::get('users', 'UserController@index');
Route::get('user/show/{id}', 'UserController@show');
//Route::post('user', 'UserController@store');
//Route::put('user', 'UserController@store');
Route::delete('user/{id}', 'UserController@destroy');

Route::get('teachers', 'TeacherController@index');
Route::get('teacher/{email}', 'TeacherController@show');
Route::post('teacher/store', 'TeacherController@store');
Route::post('teacher/update/', 'TeacherController@update');
Route::delete('teacher/{email}', 'TeacherController@destroy');

Route::post('admin/store', 'AdminController@store');
Route::post('admin/update/{email}', 'AdminController@update');

Route::post('group/store','GroupController@store');
Route::post('group/update/{id}','GroupController@update');
Route::get('group/index','GroupController@index');
Route::get('group/show/{id}','GroupController@show');

Route::post('course/store','CourseController@store');
Route::post('course/update','CourseController@update');
Route::get('course/show/{id}','CourseController@show');
Route::get('course/index','CourseController@index');
Route::post('course/getCourseByGroupId','CourseController@getCourseByGroupId');

Route::post('studymaterial/store','StudyMaterialController@store');
Route::post('studymaterial/update','StudyMaterialController@update');
Route::get('studymaterial/show/{id}','StudyMaterialController@show');
Route::get('studymaterial/index','StudyMaterialController@index');

Route::post('attendance/store','AttendanceController@store');
Route::post('attendance/update','AttendanceController@update');
Route::get('attendance/show/{id}','AttendanceController@show');
Route::get('attendance/index','AttendanceController@index');
Route::post('attendance/getAttendancelistByStudentId','AttendanceController@getAttendancelistByStudentId');

Route::post('studentgroup/store','StudentGroupController@store');
Route::post('studentgroup/update','StudentGroupController@update');
Route::get('studentgroup/show/{id}','StudentGroupController@show');
Route::get('studentgroup/index','StudentGroupController@index');
Route::post('studentgroup/getStudentByGroupId','StudentGroupController@getStudentByGroupId');

Route::post('courseteacher/store','CourseTeacherController@store');
Route::post('courseteacher/update','CourseTeacherController@update');
Route::get('courseteacher/show/{id}','CourseTeacherController@show');
Route::get('courseteacher/index','CourseTeacherController@index');
Route::post('courseteacher/getCourseByTeacherId','CourseTeacherController@getCourseByTeacherId');