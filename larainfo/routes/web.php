<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;


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

// The route for the users



    
Route::get('/', function () {
    return view('welcome');
});
// Route::get('students', [UsersController::class, 'index']);
// Route::get('students/list', [UsersController::class, 'getUsers'])->name('users.list');

Route::resource('events', EventsController::class)
->middleware(Auth::routes());
Route::resource('users', UsersController::class)
->middleware(Auth::routes());

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')
;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('events', EventsController::class);
Route::resource('users', UsersController::class);
Route::get('/connection', function() {
    try{
        DB::connection()->getPdo();
        return 'connected Successfully';
    }
    catch(\Exception $ex)
        {
            dd($ex->getMessage());
        }
    
});