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

Route::post('course/store','CourseController@store');

Route::post('studymaterial/store','StudyMaterialController@store');
Route::post('studymaterial/update','StudyMaterialController@update');
Route::get('studymaterial/show/{id}','StudyMaterialController@show');

Route::post('attendance/store','AttendanceController@store');

Route::post('studentgroup/store','StudentGroupController@store');

Route::post('courseteacher/store','CourseTeacherController@store');