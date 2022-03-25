<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Models\RoomAccessRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\EventController;

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

Route::redirect('/intra/login', env('INTRA_API_URL'))->name('intra.login');

Route::get('/intra/callback', [HomeController::class, 'callback'])->name('callback');

Route::get('/', [HomeController::class, 'welcome'])->name('home');

Route::prefix('/admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::name('admin.')->group(function () {
        Route::resource('room', RoomController::Class)->middleware('check.role');
        Route::resource('event', EventController::Class);
        Route::resource('user', UserController::Class)->middleware('check.role');
    });
});

require __DIR__ . '/auth.php';
