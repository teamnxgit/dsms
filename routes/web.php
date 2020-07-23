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
Route::post('/person/search', 'PersonController@search')->name('Person');
Route::get('/person/view/{id}', 'PersonController@person')->name('Person');
Route::get('/person/new', 'PersonController@new')->name('New Person');
/* Functions */
Route::post('/person/new/add', 'PersonController@add');


// Household
/* Views */
Route::get('/households', 'HouseholdController@index');
Route::post('/households/search/', 'HouseholdController@search');
Route::get('/household/view/{id}', 'HouseholdController@household')->name('Household');
Route::get('/household/new', 'HouseholdController@new')->name('New Household');
/* Functions */
Route::post('/household/new/add', 'HouseholdController@add');
Route::post('/household/update', 'HouseholdController@update');
Route::post('/household/delete', 'HouseholdController@delete');
Route::post('/household/facility/add', 'HouseholdController@addFacility');
Route::post('/household/facility/rem', 'HouseholdController@remFacility');
Route::post('/household/fieldnote/add', 'HouseholdController@addFieldNote');
Route::post('/household/vulnerability/rem', 'HouseholdController@remVulnerability');
Route::post('/household/vulnerability/add', 'HouseholdController@addVulnerability');
Route::post('/household/person/rem', 'PersonController@deAttachPersonFromHousehold');
Route::post('/household/person/add', 'PersonController@attachPersonToHousehold');

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
// Vulnerability
Route::get('/system/household/vulnerability/','SystemController@HouseholdVulnerabilityTypes');
Route::post('/system/household/vulnerability/add','SystemController@addHouseholdVulnerabilityTypes');
Route::post('/system/household/vulnerability/rem','SystemController@remHouseholdVulnerabilityTypes');

// Household
Route::post('/system/households/list','HouseholdController@listHousehold');

// Stationary
Route::get('/consumable', 'ConsumableController@index');
Route::get('/consumable/consumables', 'ConsumableController@consumables');
Route::Post('/consumable/add', 'ConsumableController@add');
Route::Post('/consumable/editstock', 'ConsumableController@editstock');
Route::Post('/consumable/rem', 'ConsumableController@rem');
Route::Post('/consumable/receive', 'ConsumableController@receive');
Route::Post('/consumable/issue', 'ConsumableController@issue');
Route::get('/consumable/item/{id}', 'ConsumableController@item');

});