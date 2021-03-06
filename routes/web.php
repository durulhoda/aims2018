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
Route::get('/', 'frontController@index');
Route::get('/error', function(){
return view('errorpage');
});
// Role Settings
Auth::routes();
Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::resource('role','role\RoleController');
Route::resource('permission','role\PermissionController');
Route::resource('user','UserController');
// Common Settings
Route::resource('division', 'institutesettings\DivisionController')->middleware('auth');
Route::resource('district', 'institutesettings\DistrictController');
Route::resource('thana', 'institutesettings\ThanaController');
Route::resource('localgov', 'institutesettings\LocalGovController');
Route::resource('postoffice', 'institutesettings\PostOfficeController');
// 	General Settings
Route::resource('institutetype', 'institutesettings\InstituteTypeController');
Route::resource('institutecategory', 'institutesettings\InstituteCategoryController');
Route::resource('institutesubcategory', 'institutesettings\InstituteSubCategoryController');
Route::resource('unit', 'institutesettings\UnitController');
// Institute Settings
Route::resource('institute', 'institutesettings\InstituteController');
Route::resource('instituteReg', 'institutesettings\InstituteRegController');
Route::resource('domain', 'institutesettings\DomainController');
Route::resource('vprogramlevels', 'institutesettings\VProgramLevelsController');
Route::resource('vprogramgroup', 'institutesettings\VProgramGroupController');
Route::resource('admissionprogram', 'institutesettings\AdmissionProgramController');
// Basic Settings
Route::resource('session', 'settings\SessionController');
Route::resource('programLevel', 'settings\ProgramLevelController');
Route::resource('group', 'settings\GroupController');
Route::resource('program', 'settings\ProgramController');
Route::resource('medium', 'settings\MediumController');
Route::resource('shift', 'settings\ShiftController');
Route::resource('quota', 'settings\QuotaController');
Route::resource('programoffer', 'settings\ProgramOfferController');
Route::resource('rolequota', 'settings\RoleQuotaController');


Route::resource('course', 'settings\CourseController');
Route::post('/getprogramoffer/', 'settings\CourseOfferController@programofferresult');

Route::resource('section', 'settings\SectionController');
Route::resource('subjectcode', 'settings\SubjectCodeController');
Route::resource('courseoffer', 'settings\CourseOfferController');


// Employee Settings
Route::resource('employeeType', 'employee\EmployeeTypeController');
Route::resource('employeedesignation', 'employee\EmployeeDesignationController');
Route::resource('department', 'employee\DepartmentController');
Route::resource('employee', 'employee\EmployeeController');

// Student Settings
Route::resource('applicant', 'studentsettings\ApplicantController');
Route::resource('student', 'studentsettings\StudentController');

// Menu Settings
Route::resource('menu', 'menusettings\MenuController');

// For school Section
Route::get('/school', function () {
    return view('school.home');
});
Route::resource('admission', 'school\AdmissionController');
// For Ajax 
Route::get('/getPrograms/','AjaxController@getPrograms');
Route::get('/getGroupByLevel/','AjaxController@getGroupByLevel');
Route::get('/getCourse/','AjaxController@getCourse');
Route::get('/getdistrict/','AjaxController@getDistbydivision');
Route::get('/getthana/','AjaxController@getThanabydistrict');
Route::get('/getpostoffice/','AjaxController@getPostOfficebyThana');
Route::get('/getunion/','AjaxController@getUnionbyThana');
Route::get('/getOwnRole/','AjaxController@getOwnRole');
Route::get('/editRolePower/','AjaxController@editRolePower');
Route::get('/createRolePower/','AjaxController@createRolePower');
Route::get('/actionForParentRole/','AjaxController@actionForParentRole');
Route::get('/actionForQuota/','AjaxController@actionForQuota');
Route::get('/quotaActionBetweenRole/','AjaxController@quotaActionBetweenRole');

Route::get('/getValue/','AjaxController@getValue');
Route::get('/getValueWithSession/','AjaxController@getValueWithSession');
// School Ajax Controller
Route::get('/getValue2/','SchollAjaxController@getValue');
Route::get('/getValueWithIstitute/','SchollAjaxController@getValueWithIstitute');
Route::get('/getValueWithSession2/','SchollAjaxController@getValueWithSession');

// Api Controllers
Route::get('aimsapi/read/','AimsApiController@read');
Route::post('aimsapi/insert/','AimsApiController@insert');


