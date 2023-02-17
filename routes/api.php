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

Route::prefix('v1')->middleware(['auth:api','cors'])->name('v1')->group(function(){
    Route::get('profile', [ProfilesController::class, 'profile']);
    Route::resource('contacts', ContactsController::class);
    Route::resource('districts', DistrictsController::class);
    Route::resource('farms', FarmsController::class);
    Route::resource('field-templates', FieldTemplatesController::class);
    Route::resource('form-categories', FormCategoriesController::class);
    Route::resource('form-fields', FormFieldsController::class);
    Route::resource('forms', FormsController::class);
    Route::resource('organisations', OrganisationsController::class);
    Route::resource('regions', RegionsController::class);
    Route::resource('reports', ReportsController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class)->middleware('role:super-admin|admin');
});
