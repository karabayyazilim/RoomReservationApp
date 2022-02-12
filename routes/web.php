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

Route::get('/data', function () {
    $start = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '2022-02-13 01:10:00');
    $end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '2022-02-13 02:30:00');
    $event = \App\Models\Event::where('room_id' , 22)
        ->whereBetween('start_date', array($start, $end))
        ->get();
    dd($event);
});


Route::redirect('/intra/login', 'https://api.intra.42.fr/oauth/authorize?client_id=4d11ff1ff804cf025e19b7bf317b71676506457211ea95bf33eebbc9088a605b&redirect_uri=http%3A%2F%2Flocalhost%2Fintra%2Fcallback&response_type=code');

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
