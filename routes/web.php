<?php

use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\FarmsController;
use App\Http\Controllers\General\ContactsController;
use App\Http\Controllers\Specialist\OrganizationsController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware('verify-admin')->group(function(){
    Route::resource('users', AdminUsersController::class);
});

Route::prefix('specialist')->name('specialist.')->middleware('verify-specialist')->group(function(){
    Route::resource('organizations', OrganizationsController::class);
    Route::resource('farms', FarmsController::class);
});

Route::prefix('general')->name('general.')->middleware('role:admin|specialist|super-admin')->group(function(){
    Route::resource('contacts', ContactsController::class);
});
