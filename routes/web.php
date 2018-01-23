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

/**
 * Debug
 */
 Route::get('/debug','LoginController@debug');
 
 
/**
 * Authentication
 */
Route::get('/','LoginController@index');
Route::post('/process/login','LoginController@login');
Route::get('/process/logout','LogoutController@logout');
Route::get('/lock','LockScreenController@lockScreen');
Route::post('process/signin','LockScreenController@signin');



/*AJAX*/
Route::get('/admin/check-username-availability','AdminController@checkUsernameAvailability');
Route::get('/admin/check-email-availability','AdminController@checkEmailAvailability');
Route::get('/admin/check-edit-username-availability','AdminController@checkEditUsernameAvailability');
Route::get('/admin/check-edit-email-availability','AdminController@checkEditEmailAvailability');

Route::get('/user/check-username-availability','UserController@checkUsernameAvailability');
Route::get('/user/check-email-availability','UserController@checkEmailAvailability');
Route::get('/user/check-edit-username-availability','UserController@checkEditUsernameAvailability');
Route::get('/user/check-edit-email-availability','UserController@checkEditEmailAvailability');

/*Dashboard*/
Route::get('/admin','AdminController@index');

/*Settings*/
Route::get('/admin/settings','AdminController@settings');
Route::put('/admin/settings/update','AdminController@updateSettings');


/*Payslip*/
Route::get('/admin/payslip','AdminController@payslip');
Route::get('/admin/payslip/new','AdminController@addPayslip');
Route::delete('/admin/payslip/delete','AdminController@deletePayslips');
Route::put('/admin/process/add-payslip','AdminController@processAddPayslip');
Route::put('/admin/process/bulk-add-payslip','AdminController@processBulkAddPayslip');
Route::get('/admin/generate-pdf/{id}','ReportsController@generatePayslip');

/**Employees**/
Route::get('/admin/employees','AdminController@employees');
Route::get('/admin/employee/new','AdminController@addEmployee');
Route::get('/admin/edit/employee/{id}','AdminController@editEmployee');

Route::put('/admin/process/add-employee','AdminController@processAddEmployee');
Route::get('/admin/edit/applicant/{id}','AdminController@editApplicant');
Route::delete('/admin/employees/delete/','AdminController@deleteEmployees');

/**Applicants**/
Route::get('/admin/applicants','AdminController@applicants');
Route::delete('/admin/applicant/delete','AdminController@deleteApplicants');
Route::put('/admin/process/edit-employee','AdminController@processEditEmployee');

/*Profile*/
Route::get('/admin/profile','AdminController@profile');
Route::put('/admin/process/edit-login','AdminController@processEditLogin');
Route::put('/admin/process/edit-profile','AdminController@processEditProfile');
Route::put('/admin/process/edit-statutories','AdminController@processEditStatutories');


/*Leaves*/
Route::get('/admin/leaves','AdminController@leaves');
Route::get('/admin/add-leave','AdminController@addLeave');
Route::put('/admin/process/add-leave','AdminController@processRequestLeave');
Route::get('/admin/edit-leave/{id}','AdminController@editLeave');
Route::put('/admin/process/edit-leave','AdminController@processEditLeave');

/*Jobs*/
Route::get('/admin/jobs','AdminController@jobs');
Route::get('/admin/job/new','AdminController@addJobs');
Route::put('/admin/process/add-job','AdminController@processAddJob');
Route::delete('/admin/jobs/delete/','AdminController@deleteJobs');
Route::get('/admin/edit/job/{id}','AdminController@editJob');
Route::put('/admin/process/edit-job','AdminController@processEditJob');

/*Departments*/
Route::get('/admin/departments','AdminController@departments');
Route::get('/admin/department/new','AdminController@addDepartment');
Route::get('/admin/edit/department/{id}','AdminController@editDepartment');
Route::put('/admin/process/add-department','AdminController@processAddDepartment');
Route::put('/admin/process/edit-department','AdminController@processEditDepartment');
Route::delete('/admin/departments/delete/','AdminController@deleteDepartments');
 
/*Files*/
Route::get('/admin/files','AdminController@files');
Route::post('/process/file-upload','FileController@fileUpload');
Route::get('/process/delete-file/{id}','FileController@deleteFile');

/*Overtime*/ 
Route::get('/admin/overtime','AdminController@overtime');
Route::get('/admin/view-overtime/{id}','AdminController@viewOvertime');
Route::get('/admin/add-overtime','AdminController@addOvertime');
Route::put('/admin/process/request-overtime','AdminController@processUpdateOvertime');
Route::put('/admin/process/add-overtime','AdminController@processAddOvertime');

/*Biometrics*/
Route::get('/admin/edit/attendance/{id}','AdminController@editAttendance');
Route::get('/admin/attendance','AdminController@attendance');
Route::delete('/admin/attendance/delete/','AdminController@deleteAttendance');
Route::put('/admin/process/add-attendance','AdminController@processAddAttendance');
Route::put('/admin/process/edit-attendance','AdminController@processeditAttendance');


/*Company Structure*/
Route::get('/admin/company-structure','AdminController@companyStructure');

/*Reports*/
Route::get('/admin/reports/employee-list','ReportsController@employeeListReports');
Route::post('/admin/reports/applicant','ReportsController@applicantReportViaID');
Route::post('/admin/reports/employee','ReportsController@employeeReportViaID');
/**
 * Users 
 */
Route::get('/user','UserController@index');

/*Profile*/
Route::get('/user/profile','UserController@profile');

Route::put('/user/process/edit-statutories','UserController@processEditStatutories');
Route::put('/user/process/edit-login','UserController@processEditLogin');
Route::put('/user/process/edit-profile','UserController@processEditProfile');	

/*Files*/
Route::get('/user/files','UserController@files');
Route::post('/process/file-upload','FileController@fileUpload');
Route::get('/process/delete-file/{id}','FileController@deleteFile');
	
/*Payslip*/
Route::get('/user/payslip','UserController@payslip');
Route::get('/user/generate-pdf/{id}','ReportsController@generatePayslip');

/*Leaves*/
Route::get('/user/request-leave','UserController@requestLeave');
Route::get('/user/leaves','UserController@leaves');
Route::put('/user/process/request-leave','UserController@processRequestLeave');
Route::get('/user/view-leave/{id}','UserController@viewLeave');

/*Overtime Request*/
Route::get('/user/overtime','UserController@overtime');
Route::get('/user/view-overtime/{id}','UserController@viewOvertime');
Route::get('/user/overtime-approval/','UserController@overtimeApproval');
Route::put('/user/process/request-overtime','UserController@processRequestOvertime');

/**
 * Guest Controller
 */
Route::get('/application-form/key/{key}','GuestController@applicationForm'); 
Route::get('/application-form/generate-key','GuestController@generateFormKey'); 
Route::get('/application-form/restrict-key','GuestController@deleteFormKey'); 
Route::post('/application-form/submit','GuestController@saveForm'); 

/*Debug*/
Route::get('/email','AdminController@debug'); 
Route::get('/user/debug','UserController@debug'); 


