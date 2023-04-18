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

Route::get('/', 'PublicController@index')->name('public.index');
Route::get('/type1', 'PublicController@type1')->name('type1');
Route::get('/type2', 'PublicController@type2')->name('type2');
Route::get('/Add-new','PublicController@addNew')->name('ads.create');
Route::post('/Ads-Save','PublicController@store')->name('ads.store');

Route::post('/Result','PublicController@result')->name('Public.result');
Route::get('/admin', 'AdminController@index');
Route::resource('/users', 'UsersController');
Route::resource('/Universities', 'UniversitiesController');
Route::put('/Universities/unpublish/{id}', 'UniversitiesController@unpublish')->name('Universities.unpublish');
Route::put('/Universities/publish/{id}', 'UniversitiesController@publish')->name('Universities.publish');


Route::put('/faculity/percent/{id}', 'FacultiesController@percent')->name('faculity.percent');
Route::resource('/Faculties', 'FacultiesController');
Route::put('/Faculties/unpublish/{id}', 'FacultiesController@unpublish')->name('Faculties.unpublish');
Route::put('/Faculties/publish/{id}', 'FacultiesController@publish')->name('Faculties.publish');

Route::resource('/Categories', 'CategoriesController');
Route::put('/Categories/unpublish/{id}', 'CategoriesController@unpublish')->name('Categories.unpublish');
Route::put('/Categories/publish/{id}', 'CategoriesController@publish')->name('Categories.publish');

Route::resource('/States', 'StatesController');
Route::put('/States/unpublish/{id}', 'StatesController@unpublish')->name('States.unpublish');
Route::put('/States/publish/{id}', 'StatesController@publish')->name('States.publish');

Route::resource('/Departments', 'DepartmentsController');
Route::put('/Departments/unpublish/{id}', 'DepartmentsController@unpublish')->name('Departments.unpublish');
Route::put('/Departments/publish/{id}', 'DepartmentsController@publish')->name('Departments.publish');

Route::put('/users/reset-password/{id}', 'UsersController@resetPassword')->name('users.reset');
Route::put('/users/makeUser/{id}', 'UsersController@makeUser')->name('pgCompany.makeUser');
Route::put('/users/makeAdmin/{id}', 'UsersController@makeAdmin')->name('pgCompany.makeAdmin');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{id}', 'HomeController@edit')->name('edit');
Route::get('/update-done/{id}', 'HomeController@done')->name('done');
Route::post('/update/{id}', 'HomeController@update')->name('ads.update');

Route::post('facultyUpdate/{id}', 'FacultiesController@facultyUpdate')->name('facultyUpdate');
Route::post('getByUniversity', 'FacultiesController@getByUniversity')->name('getByUniversity');

Route::get('my-captcha', 'HomeController@myCaptcha')->name('myCaptcha');
Route::post('my-captcha', 'HomeController@myCaptchaPost')->name('myCaptcha.post');
Route::get('refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');