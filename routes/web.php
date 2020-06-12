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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){

Route::get('/person', 'PersonController@index')->name('Person');
Route::get('/person/search', 'PersonController@index')->name('Person');
Route::get('/person/search/{id}', 'PersonController@search')->name('person');
Route::get('/person/details/{id}', 'PersonController@person')->name('Person');
Route::get('/person/new', 'PersonController@new')->name('New Person');
Route::get('/person/update/essential/{id}', 'PersonController@essential')->name('Essential Details');
Route::get('/person/update/house/{id}', 'PersonController@house')->name('HouseDetails');
Route::get('/person/update/occupation/{id}', 'PersonController@occupation')->name('Occupation Details');
Route::get('/person/update/disability/{id}', 'PersonController@disability')->name('Disability Details');

// Household
/* Views */
Route::get('/household', 'HouseholdController@index');
Route::get('/household/search', 'HouseholdController@index');
Route::get('/household/search/{id}', 'HouseholdController@search');
Route::get('/household/view/basic/{id}', 'HouseholdController@basic')->name('Household Basic Details');
Route::get('/household/view/essential/{id}', 'HouseholdController@essential')->name('Household Essential Details');
Route::get('/household/view/facilities/{id}', 'HouseholdController@facilities')->name('Household Facilities');
Route::get('/household/view/disaster/{id}', 'HouseholdController@disaster')->name('Household Disaster');
Route::get('/household/new', 'HouseholdController@new')->name('New Household');
/* Functions */
Route::post('/household/new/add', 'HouseholdController@add');
Route::post('/household/update/essential/', 'HouseholdController@updateEssesntial');
Route::post('/household/update/basic/', 'HouseholdController@updateBasic');



// User
Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@user');
Route::post('/user/{id}/addpermission', 'UserController@addPermission');
Route::post('/user/{id}/rempermission', 'UserController@remPermission');
Route::post('/user/{id}/updateuser', 'UserController@updateUser');
Route::get('/users/seed','UserController@seedUser');

/* System Routes */
Route::get('/system','SystemController@index');
// GN Divisions
Route::get('/system/gndivisions','SystemController@veiwGNDivision');
Route::post('/system/gndivisions/add','SystemController@addGNDivision');
Route::post('/system/gndivisions/rem','SystemController@remGNDivision');
// Towns / Villages
Route::get('/system/towns','SystemController@veiwTown');
Route::post('/system/towns/add','SystemController@addTown');
Route::post('/system/towns/rem','SystemController@remTown');
Route::post('/system/towns/list','SystemController@listTown');
// Streets
Route::get('/system/streets','SystemController@veiwStreet');
Route::post('/system/streets/add','SystemController@addStreet');
Route::post('/system/streets/rem','SystemController@remStreet');
Route::post('/system/streets/list','SystemController@listStreet');

});



