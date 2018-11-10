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
// Route::get('/', function () {
//     return view('home');
// })->middleware('auth');
Route::get('/', 'HomeController@index')->middleware('auth')->name('home');
// Role Settings
Auth::routes();
Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::resource('role','RoleController');
// Institute Settings
Route::resource('division', 'institutesettings\DivisionController')->middleware('auth');
Route::resource('district', 'institutesettings\DistrictController');
Route::resource('thana', 'institutesettings\ThanaController');
Route::resource('localgov', 'institutesettings\LocalGovController');
Route::resource('postoffice', 'institutesettings\PostOfficeController');
Route::resource('institutetype', 'institutesettings\InstituteTypeController');
Route::resource('institutecategory', 'institutesettings\InstituteCategoryController');
Route::resource('institutesubcategory', 'institutesettings\InstituteSubCategoryController');
Route::resource('institute', 'institutesettings\InstituteController');
Route::resource('unit', 'institutesettings\UnitController');

// General Settings
Route::resource('session', 'settings\SessionController');
Route::resource('programLevel', 'settings\ProgramLevelController');
Route::resource('group', 'settings\GroupController');
Route::resource('program', 'settings\ProgramController');
Route::resource('medium', 'settings\MediumController');
Route::resource('shift', 'settings\ShiftController');
Route::resource('programoffer', 'settings\ProgramOfferController');

Route::resource('course', 'settings\CourseController');
Route::post('/getprogramoffer/', 'settings\CourseOfferController@programofferresult');

Route::resource('section', 'settings\SectionController');
Route::resource('subjectcode', 'settings\SubjectCodeController');
Route::resource('courseoffer', 'settings\CourseOfferController');


// For Employee related
Route::resource('employeeType', 'employee\EmployeeTypeController');
Route::resource('employeedesignation', 'employee\EmployeeDesignationController');
Route::resource('department', 'employee\DepartmentController');
Route::resource('employee', 'employee\EmployeeController');

// For Student related
Route::resource('applicant', 'studentsettings\ApplicantController');
Route::resource('student', 'studentsettings\StudentController');


// For Ajax 
Route::get('/getPrograms/','AjaxController@getPrograms');
Route::get('/getGroupByLevel/','AjaxController@getGroupByLevel');
Route::get('/getCourse/','AjaxController@getCourse');
Route::get('/getdistrict/','AjaxController@getDistbydivision');
Route::get('/getthana/','AjaxController@getThanabydistrict');
Route::get('/getpostoffice/','AjaxController@getPostOfficebyThana');
Route::get('/getunion/','AjaxController@getUnionbyThana');



// Menu Settings
Route::resource('menu', 'menusettings\MenuController');
Route::resource('rolemenu','menusettings\RoleMenuController');

