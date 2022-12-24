<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DownloadController;

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


Route::get('/', 'DisplayController@index');
Route::post('/guide', 'RegistrationController@guide')->name('guideCreateLink');


Route::get('/guide_download/{guideName}', 'DownloadController@guide')->name('guideDownloadLink');

/* → Documents*/
Route::get('/documents', 'DisplayController@documentList')->name('documentLink');
Route::get('/favorites', 'DisplayController@favoriteList')->name('favoritesLink');

/* → Project*/
Route::get('/projects', 'DisplayController@projectList')->name('projectLink');

/* → AddProject*/
Route::get('/add_projects', 'DisplayController@addProject')->name('addProjectLink');

/* → createFile*/
Route::get('/create_file', 'DisplayController@createFile')->name('createFileLink');
/* → folderPage*/
Route::get('/folder_Page/{id}', 'DisplayController@folderPage')->name('folderPageLink');

/* → addProject*/
Route::post('/save_project', 'RegistrationController@saveProject')->name('save.project');

/**/
Route::get('/project/{id}/edit', 'DisplayController@editView')->name('projectEditLink');
Route::post('/project/{id}/update', 'DisplayController@updateView')->name('update.project');

Route::post('/save_folder/{id}', 'RegistrationController@saveFolder')->name('save.folder');

Route::post('/save_file', 'RegistrationController@saveFile')->name('save.file');

Route::get('/document_page/{id}', 'DisplayController@documentPage')->name('documentPageLink');

Route::get('/documents/search', 'DisplayController@searchDocuments')->name('searchDocumentsLink');
Route::get('/favorites/search', 'DisplayController@searchFavorites')->name('searchFavoritesLink');

Route::get('/file_download/{id}', 'DownloadController@file')->name('fileDownloadLink');

Auth::routes();

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

/* → Favorites(System Home)*/
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::post('/project/destroy/{id}', 'AjaxController@destroyProject'); /* レコード削除 */
Route::post('/ajax/selectFolder', 'AjaxController@selectFolder'); /* レコード削除 */

Route::post('/like/{postId}','LikeController@store');
Route::post('/unlike/{postId}','LikeController@destroy');

