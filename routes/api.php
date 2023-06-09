<?php

use App\Http\Controllers\Api\v1\ContactsController;
use App\Http\Controllers\Api\v1\DistrictsController;
use App\Http\Controllers\Api\v1\FarmsController;
use App\Http\Controllers\Api\v1\FieldTemplatesController;
use App\Http\Controllers\Api\v1\FormCategoriesController;
use App\Http\Controllers\Api\v1\FormFieldsController;
use App\Http\Controllers\Api\v1\FormsController;
use App\Http\Controllers\Api\v1\OrganisationsController;
use App\Http\Controllers\Api\v1\ProfilesController;
use App\Http\Controllers\Api\v1\RegionsController;
use App\Http\Controllers\Api\v1\ReportsController;
use App\Http\Controllers\Api\v1\RolesController;
use App\Http\Controllers\Api\v1\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'App\Http\Controllers\Api\v1\ApiLoginController@login');
Route::post('register', 'App\Http\Controllers\Api\v1\ApiLoginController@register');
Route::middleware('auth:sanctum')->post('logout', 'App\Http\Controllers\Api\v1\ApiLoginController@logout');

// Получение всех записей с проверкой на токен
Route::middleware('auth:sanctum')->get('farms', 'App\Http\Controllers\Api\v1\FarmController@index');
Route::middleware('auth:sanctum')->get('contacts', 'App\Http\Controllers\Api\v1\ContactsController@index');
Route::middleware('auth:sanctum')->get('districts', 'App\Http\Controllers\Api\v1\DistrictsController@index');
Route::middleware('auth:sanctum')->get('fieldtemplates', 'App\Http\Controllers\Api\v1\FieldTemplatesController@index');
Route::middleware('auth:sanctum')->get('formcategories', 'App\Http\Controllers\Api\v1\FormCategoriesController@index');
Route::middleware('auth:sanctum')->get('formfields', 'App\Http\Controllers\Api\v1\FormFieldsController@index');
Route::middleware('auth:sanctum')->get('forms', 'App\Http\Controllers\Api\v1\FormsController@index');
Route::middleware('auth:sanctum')->get('organisations', 'App\Http\Controllers\Api\v1\OrganisationsController@index');
Route::middleware('auth:sanctum')->get('profiles', 'App\Http\Controllers\Api\v1\ProfilesController@index');
Route::middleware('auth:sanctum')->get('regions', 'App\Http\Controllers\Api\v1\RegionsController@index');
Route::middleware('auth:sanctum')->get('reports', 'App\Http\Controllers\Api\v1\ReportsController@index');
Route::middleware('auth:sanctum')->get('roles', 'App\Http\Controllers\Api\v1\RolesController@index');
Route::middleware('auth:sanctum')->get('farms', 'App\Http\Controllers\Api\v1\FarmController@index');
Route::middleware('auth:sanctum')->get('media', 'App\Http\Controllers\Api\v1\MediaController@index');
Route::middleware('auth:sanctum')->get('users', 'App\Http\Controllers\Api\v1\UsersController@index');
Route::middleware('auth:sanctum')->get('passwordresets', 'App\Http\Controllers\Api\v1\PasswordResetsController@index');


// UpdateOrCreate
Route::middleware('auth:sanctum')->post('media_update/{id}', 'App\Http\Controllers\Api\v1\MediaController@updateOrCreate');
Route::middleware('auth:sanctum')->post('users_update/{id}', 'App\Http\Controllers\Api\v1\UsersController@updateOrCreate');
Route::middleware('auth:sanctum')->post('contacts_update/{id}', 'App\Http\Controllers\Api\v1\ContactsController@updateOrCreate');
Route::middleware('auth:sanctum')->post('districts_update/{id}', 'App\Http\Controllers\Api\v1\DistrictsController@updateOrCreate');
Route::middleware('auth:sanctum')->post('farms_update/{id}', 'App\Http\Controllers\Api\v1\FarmController@updateOrCreate');
Route::middleware('auth:sanctum')->post('fieldtemplates_update/{id}', 'App\Http\Controllers\Api\v1\FieldTemplatesController@updateOrCreate');
Route::middleware('auth:sanctum')->post('formcategories_update/{id}', 'App\Http\Controllers\Api\v1\FormCategoriesController@updateOrCreate');
Route::middleware('auth:sanctum')->post('formfields_update/{id}', 'App\Http\Controllers\Api\v1\FormFieldsController@updateOrCreate');
Route::middleware('auth:sanctum')->post('organisations_update/{id}', 'App\Http\Controllers\Api\v1\OrganisationsController@updateOrCreate');
Route::middleware('auth:sanctum')->post('reports_update/{id}', 'App\Http\Controllers\Api\v1\ReportsController@updateOrCreate');
Route::middleware('auth:sanctum')->post('regions_update/{id}', 'App\Http\Controllers\Api\v1\RegionsController@updateOrCreate');

// Загрузка медиа
Route::middleware('auth:sanctum')->post('media_get', 'App\Http\Controllers\Api\v1\MediaController@store');

// Скачивание медиа
Route::middleware('auth:sanctum')->get('media_download/{id}', 'App\Http\Controllers\Api\v1\MediaController@download');


// Удаление медиа
Route::middleware('auth:sanctum')->delete('media_delete/{id}', 'App\Http\Controllers\Api\v1\MediaController@destroy');

// Восстановление пароля
Route::post('passwordresets_update/{email}', 'App\Http\Controllers\Api\v1\PasswordResetsController@updateOrCreate');

//Тестовый маршрут
Route::get('/test', function(){
    return 'ok';
});



