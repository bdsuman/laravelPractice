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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/profile', function () {
//     return view('user.profile');
// });

// Route::get('/blogList', [App\Http\Controllers\BlogController::class, 'list']);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'aboutUs']);

// *****************************************


Route::get('/', [App\Http\Controllers\Admin\MasterController::class, 'dashboard']);
// USER ROUTE
Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('usersIndex');
Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('usersCreate');
Route::post('users/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('usersStore');
Route::get('users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('usersEdit');
Route::put('users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('usersUpdate');
Route::delete('users/destroy/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('usersDestroy');


Route::resource('blogCategory', App\Http\Controllers\Admin\BlogCategoryController::class);
