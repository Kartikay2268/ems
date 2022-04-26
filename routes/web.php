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

Route::get('/','HomeController@index');
Route::get('logout','Auth.LoginController@logout')->name('logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/details', 'DetailsController@index')->name('details');


//EmployeesController Routes
Route::get('/employees', 'EmployeesController@index')->name('employees');
Route::get('/employee/add', 'EmployeesController@addEmployee')->name('employee.add');
Route::post('/employee/submit', 'EmployeesController@submitEmployee')->name('employee.submit');
Route::get('/employee/edit/{id}', 'EmployeesController@editEmployee')->name('employee.edit');
Route::post('/employee/update', 'EmployeesController@updateEmployee')->name('employee.update');
Route::get('/employee/delete/{id}', 'EmployeesController@deleteEmployee')->name('employee.delete');
Route::get('/employee/filter', 'EmployeesController@filterEmployee')->name('employee.filter');
Route::get('/admin/salary/{id}', 'EmployeesController@salaryDetails')->name('salaryDetails');
Route::post('/salary/update', 'EmployeesController@salaryUpdate')->name('salaryUpdate');

//TeamController Routes
Route::get('/teams','TeamController@index')->name('teams');
Route::get('/teams/add','TeamController@addTeam')->name('teams.add');
Route::post('/teams/add/submit','TeamController@submitTeam')->name('teams.submit');
Route::get('/teams/manage/{id}','TeamController@manageTeam')->name('teams.manage');
Route::get('/teams/manage/{id}/addmember','TeamController@addMember')->name('teams.addMember');
Route::post('/teams/manage/add', 'TeamController@addMemberSubmit')->name('teams.addMemberSubmit');
Route::get('/teams/manage/{id}/delete/{member_id}', 'TeamController@deleteMember')->name('teams.deleteMember');
Route::get('/teams/manage/delete/{team_id}', 'TeamController@deleteTeam')->name('teams.deleteTeam');
Route::get('/teams/manage/edit/{id}', 'TeamController@editTeam')->name('teams.editTeam');
Route::post('/teams/manage/edit/submit', 'TeamController@editTeamSubmit')->name('teams.editTeamSubmit');

//ManagerTeamController Routes
Route::get('/manager/team', 'ManagerTeamController@index')->name('managerTeam');
Route::get('/manager/team/member/{id}', 'ManagerTeamController@viewMember')->name('viewMember');

//Attendance Routes
Route::get('/attendance', 'AttendanceController@index')->name('attendance');
Route::get('/attendance/punchIn', 'AttendanceController@punchIn')->name('attendance.punchIn');
Route::get('/attendance/punchOut', 'AttendanceController@punchOut')->name('attendance.punchOut');
Route::get('/attendance/approve/{id}', 'AttendanceController@approveAttendance')->name('attendance.approve');
Route::get('attendance/deny/{id}', 'AttendanceController@denyAttendance')->name('attendance.deny');
