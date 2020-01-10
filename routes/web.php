<?php
use Illuminate\Http\Request;
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
//     return view('welcome');
// });

Route::get('/send/email', 'AdminController@mail');

Route::get('/', 'PortalController@index')->name('index');
Route::get('/job-listing', 'PortalController@job_listing')->name('job_listing');
Route::get('/job-desc/{id}', 'PortalController@single_job')->name('single_job');

Route::get('companies-listing', 'PortalController@companies_listing')->name('companies_listing');
Route::get('company-profile/{id}', 'PortalController@company_profile')->name('company_profile');


Route::get('/maps', function () {
    return view('maps');
});

Auth::routes();

Route::post('/render_data', 'PagesController@render_data')->name('render_data');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/messages', 'AdminController@messages')->name('messages');
Route::get('/bookmarks', 'AdminController@bookmarks')->name('bookmarks');
Route::get('/review', 'AdminController@review')->name('review');
Route::get('/manage-jobs', 'AdminController@manage_jobs')->name('manage_jobs');




#==============================
#======Admin Routes=======
#==============================







#==============================
#======Admin Routes=======
#==============================

Route::get('/companies', 'AdminController@companies')->name('companies');




#==============================
#======Job Seeker Routes=======
#==============================

Route::get('/resume', 'JobSeekerController@resume')->name('resume');
Route::get('/education-details', 'JobSeekerController@education_details')->name('education_details');
Route::get('/add-edu-details', 'JobSeekerController@add_education_details')->name('add_education_details');
Route::post('/save_education', 'JobSeekerController@save_education')->name('save_education');

Route::get('/edit_education/{id}', 'JobSeekerController@edit_education')->name('edit_education');

Route::delete('/delete_edu/{id}', 'JobSeekerController@delete_edu')->name('delete_edu');

Route::post('/update_edu/{id}', 'JobSeekerController@update_edu')->name('update_edu');

Route::get('/experience-details', 'JobSeekerController@experience_details')->name('experience_details');
Route::get('/add-experience', 'JobSeekerController@add_experience')->name('add_experience');
Route::post('/save-experience', 'JobSeekerController@save_experience')->name('save_experience');
Route::get('/edit-experience/{id}', 'JobSeekerController@edit_experience')->name('edit_experience');
Route::delete('/delete-experience/{id}', 'JobSeekerController@delete_experience')->name('delete_experience');
Route::post('/update-experience/{id}', 'JobSeekerController@update_experience')->name('update_experience');

Route::post('/render-data', 'PagesController@render_data')->name('render_data');

// Route::post('/save-job', 'AdminController@saveJob')->name('saveJob');

#==================================
#======END Job Seeker Routes=======
#==================================




#===================================
#======User Controller Routes=======
#===================================

Route::get('/account-setting', 'UsersController@account_setting')->name('account_setting');
Route::post('/update-user', 'UsersController@update')->name('update_user');

#=======================================
#======END User Controller Routes=======
#=======================================



#========================================
#======Recruiter Controller Routes=======
#========================================

#For Compnay

Route::get('/company-details', 'RecruiterController@company_details')->name('company_details');
Route::get('/add-company', 'RecruiterController@add_company')->name('add_company');
Route::post('/store_company', 'RecruiterController@store_company')->name('store_company');
Route::get('/edit-company/{id}', 'RecruiterController@edit_company')->name('edit_company');
Route::delete('/delete_company/{id}', 'RecruiterController@delete_company')->name('delete_company');
Route::post('/update_company/{id}', 'RecruiterController@update_company')->name('update_company');

#End for Company

#For job Posting

Route::get('/manage-jobs', 'RecruiterController@manage_jobs')->name('manage_jobs');
Route::get('/manage-condidates', 'RecruiterController@manage_condidates')->name('manage_condidates');
Route::get('/job-post', 'RecruiterController@job_post')->name('job_post');
Route::post('/store_job', 'RecruiterController@store_job')->name('store_job');
Route::get('/edit-job-post/{id}', 'RecruiterController@edit_job_post')->name('edit_job_post');
Route::post('/update_job_post/{id}', 'RecruiterController@update_job_post')->name('update_job_post');
Route::delete('/delete_job/{id}', 'RecruiterController@delete_job')->name('delete_job');
#End For job Posting


#============================================
#======END Recruiter Controller Routes=======
#============================================