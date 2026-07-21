<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', 'Index@index')->name('home');
Route::get('management', 'Index@management')->name('management');
Route::get('messages/{id}', 'Index@messages')->name('management.details');
Route::get('faculty', 'Index@faculty')->name('faculty');
Route::get('e-sheba/{slug}', 'Index@eSheba')->name('eSheba.details');

Route::get('photos', 'Index@photos')->name('photos');
Route::get('videos', 'Index@videos')->name('videos');
Route::get('members', 'Index@employee')->name('members');
Route::get('employee/{id}', 'Index@employee_details')->name('employee.details');

Route::get('notice', 'Index@notice')->name('notice');
Route::get('notice/{id}', 'Index@notice_details')->name('notice.details');

Route::get('results', 'Index@results')->name('results');
Route::get('admission-info', 'Index@admissionInfo')->name('admission-info');

Route::get('online-form', 'OnlineFormController@show')->name('online-form');
Route::post('online-form', 'OnlineFormController@submit')->name('online-form.submit');

Route::get('content', 'Index@index')->name('websitecontent');
Route::get('content/{slug}', 'Index@contents')->name('websitecontent.slug');
Route::get('content/{slug}/{sslug}', 'Index@contents')->name('websitecontent.sslug');
Route::get('content/{slug}/{sslug}/{ssslug}', 'Index@contents')->name('websitecontent.ssslug');

Route::any('userapprove', 'CommonController@permissions')->name('user.approve');
Route::any('usersapprove', 'CommonController@permissionsUser')->name('users.approve');
Route::get('testingdata', 'CommonController@updateSlug');
Route::any('masterdelete', 'CommonController@deletedata')->name('masterdelete');
Route::get('/common-data', 'CommonController@getRelationalData');




/*
*
*
 Chairman Login
*/

//////////////////////////////////////////////////////////////////////////////////// Admin Routing Areas /////////////////////////////////////////////////////////////////////////
// Route::get('administration', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('administration', 'Auth\LoginController@showLoginForm')->name('administration.login');
Route::post('adminlogin', 'Auth\LoginController@login')->name('adminlogin');

/* Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('register', ['as' => '', 'uses' => 'Auth\RegisterController@register']); */

Route::group(['prefix' => 'administration',  'middleware' => 'auth:administration'], function () {
	Route::post('/logout', ['uses' => 'Auth\LoginController@logout'])->name('administration.logout');
	// Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard'])->name('dashboard');
	Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);

	Route::post('/password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
	Route::get('/password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
	Route::post('/password/reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);
	Route::get('/password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

	Route::any('masterdelete', 'CommonController@deletedata');
	Route::any('permissions', 'CommonController@permissions')->name('permissions');
	Route::any('permissionsuser', 'CommonController@permissionsUser')->name('permissionsuser');

	Route::get('/article/ajaxsearch', 'ArticleController@searchajax')->name('article.ajaxsearch');

	Route::resource('admins', 'AdminController');
	Route::resource('logo', 'LogoController');
	Route::resource('management', 'ManagementController');
	Route::resource('fixbanner', 'FixbannerController');


	Route::get('/samplefiledownload', 'CommonController@sampleFileDownload')->name('sampleDownload');
	Route::post('/import', 'CommonController@import')->name('import');
});

