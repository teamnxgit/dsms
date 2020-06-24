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
Route::get('/households', 'HouseholdController@index');
Route::get('/households/search/{id}', 'HouseholdController@search');
Route::get('/household/view/{id}', 'HouseholdController@household')->name('Household');
Route::get('/household/new', 'HouseholdController@new')->name('New Household');
/* Functions */
Route::post('/household/new/add', 'HouseholdController@add');
Route::post('/household/delete', 'HouseholdController@delete');
Route::post('/household/facility/add', 'HouseholdController@addFacility');

// User
Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@user');
Route::post('/user/{id}/addpermission', 'UserController@addPermission');
Route::post('/user/{id}/rempermission', 'UserController@remPermission');
Route::post('/user/{id}/updateuser', 'UserController@updateUser');
Route::get('/users/seed','UserController@seedUser');


/* System Routes */
Route::get('/system','SystemController@index');
Route::get('/system/household','SystemController@household');
Route::get('/system/person','SystemController@person');
// GN Divisions
Route::get('/system/gndivisions','GNDivisionController@veiwGNDivision');
Route::post('/system/gndivisions/add','GNDivisionController@addGNDivision');
Route::post('/system/gndivisions/rem','GNDivisionController@remGNDivision');
// Towns / Villages
Route::get('/system/towns','TownController@veiwTown');
Route::post('/system/towns/add','TownController@addTown');
Route::post('/system/towns/rem','TownController@remTown');
Route::post('/system/towns/list','TownController@listTown');
// Streets
Route::get('/system/streets','StreetController@veiwStreet');
Route::post('/system/streets/add','StreetController@addStreet');
Route::post('/system/streets/rem','StreetController@remStreet');
Route::post('/system/streets/list','StreetController@listStreet');
// Facility Types
Route::get('/system/facilitytypes','FacilityController@veiwFacilityType');
Route::post('/system/facilitytype/add','FacilityController@addFacilityType');
Route::post('/system/facilitytype/rem','FacilityController@remFacilityType');
// Facilities
Route::get('/system/facility/{shorthand}','FacilityController@veiwFacilities');
Route::post('/system/facility/add','FacilityController@addFacility');
Route::post('/system/facility/rem','FacilityController@remFacility');

});