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
    return view('auth.login');
})->name('login');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('userlist', [App\Http\Controllers\HomeController::class, 'userlist'])->name('admin/users');
Route::get('admin/deleteuser/{id}', [App\Http\Controllers\HomeController::class, 'userdelete'])->name('admin/deleteusers');
Route::get('admin/edituser/{id}', [App\Http\Controllers\HomeController::class, 'useredit'])->name('admin/editusers');
Route::post('admin/updateuser/{id}', [App\Http\Controllers\HomeController::class, 'updateuser'])->name('admin/updateuser');
Route::get('admin/tasklist/', [App\Http\Controllers\HomeController::class, 'viewtask'])->name('admin/tasklist');
Route::get('admin/addtask/', [App\Http\Controllers\HomeController::class, 'addtask'])->name('admin/addtask');
Route::post('admin/addtasks/', [App\Http\Controllers\HomeController::class, 'addtasks'])->name('admin/addtasks');
Route::get('admin/edittask/{id}', [App\Http\Controllers\HomeController::class, 'edittask'])->name('admin/edittask');
Route::post('admin/edittasks/{id}', [App\Http\Controllers\HomeController::class, 'edittasks'])->name('admin/edittasks');
Route::get('admin/deletetask/{id}', [App\Http\Controllers\HomeController::class, 'deletetask'])->name('admin/deletetask');
Route::get('passwordrequest', [App\Http\Controllers\HomeController::class, 'forgotpage'])->name('passwordrequest');
Route::post('resetpassword', [App\Http\Controllers\HomeController::class, 'resetpassword'])->name('resetpassword');
Route::get('user/tasklist', [App\Http\Controllers\HomeController::class, 'usertasklist'])->name('user/tasklist');
Route::get('user/taskview/{id}', [App\Http\Controllers\HomeController::class, 'taskview'])->name('user/taskview');
Route::post('user/update_status/{id}', [App\Http\Controllers\HomeController::class, 'updatestatus'])->name('user/update_status');
