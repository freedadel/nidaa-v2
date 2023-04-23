<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/...', 'AdminController@admin')->name('admin.index');
Route::get('/admin-users/{id}', 'AdminController@users')->name('admin.users');
Route::get('/users-edit/{id}', 'UsersController@edit')->name('admin.edit');
Route::get('/users-delete/{id}', 'UsersController@delete')->name('admin.delete');

Route::get('/searchCase', 'HomeController@searchCase')->name('ads.searchCase');
Route::post('/searchResult', 'HomeController@searchResult')->name('ads.searchResult');
Route::get('/search', 'PublicController@search')->name('ads.search');
Route::post('/searchResultPublic', 'PublicController@searchResultPublic')->name('ads.searchResultPublic');



Route::get('/state/{id}/localities', 'PublicController@localities');

Route::get('/', 'PublicController@index')->name('public.index');
Route::get('/type1', 'PublicController@type1')->name('type1');
Route::get('/type2', 'PublicController@type2')->name('type2');
Route::get('/getByState/{id}', 'PublicController@getByState')->name('public.byState');
Route::get('/getByHtype/{id}', 'PublicController@getByHtype')->name('public.byHtype');
Route::get('/getByStatus/{id}', 'PublicController@getByStatus')->name('public.byStatus');
Route::get('/Add-new','PublicController@addNew')->name('ads.create');
Route::post('/Ads-Save','PublicController@store')->name('ads.store');

Route::post('/Result','PublicController@result')->name('Public.result');
Route::get('/admin', 'AdminController@index');
Route::resource('/users', 'UsersController');
Route::resource('/Universities', 'UniversitiesController');
Route::put('/Universities/unpublish/{id}', 'UniversitiesController@unpublish')->name('Universities.unpublish');
Route::put('/Universities/publish/{id}', 'UniversitiesController@publish')->name('Universities.publish');




Route::resource('/States', 'StatesController');
Route::put('/States/unpublish/{id}', 'StatesController@unpublish')->name('States.unpublish');
Route::put('/States/publish/{id}', 'StatesController@publish')->name('States.publish');



Route::put('/users/reset-password/{id}', 'UsersController@resetPassword')->name('users.reset');
Route::put('/users/makeUser/{id}', 'UsersController@makeUser')->name('pgCompany.makeUser');
Route::put('/users/makeAdmin/{id}', 'UsersController@makeAdmin')->name('pgCompany.makeAdmin');
Auth::routes();

Route::get('/home', 'AdminController@admin')->name('home');
Route::get('/needs/{id}', 'AdminController@needs')->name('needs');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/public-dashboard', 'PublicController@dashboard')->name('public.dashboard');
Route::get('/{id}', 'HomeController@edit')->name('edit');
Route::get('/update-done/{id}', 'HomeController@done')->name('done');
Route::get('/update-follow/{id}', 'HomeController@follow')->name('follow');
Route::post('/update/{id}', 'HomeController@update')->name('ads.update');

Route::get('/getAdsByState/{id}', 'HomeController@getAdsByState')->name('getAdsByState');
Route::get('/getAdsByHtype/{id}', 'HomeController@getAdsByHtype')->name('getAdsByHtype');

Route::post('facultyUpdate/{id}', 'FacultiesController@facultyUpdate')->name('facultyUpdate');
Route::post('getByUniversity', 'FacultiesController@getByUniversity')->name('getByUniversity');

Route::get('my-captcha', 'HomeController@myCaptcha')->name('myCaptcha');
Route::post('my-captcha', 'HomeController@myCaptchaPost')->name('myCaptcha.post');
Route::get('refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');