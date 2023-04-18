<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\Auth\LoginController;



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


// Route::post('web/login', [LoginController::class, 'login']);

Route::get('/', function () {
    return view('welcome');
});

// Route to get the csrf token
Route::get('/sanctum/csrf-cookie', function (Request $request) {
    return response()->json([
        'csrf_token' => csrf_token(),
    ]);
});

// Route to get the path of the images from laravel
Route::get('/images/{filename}', function ($filename) {
    // this is the path to public folder 
    // filename is the image name
    $path = public_path('images/'.$filename);
    if (!File::exists($path)) {
        abort(404);
    }

    // getting the file from path
    $file = File::get($path);
    $type = File::mimeType($path);

    // the response to give the image with status code 200
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->where('filename', '.*');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('users', UsersController::class);
});
Route::middleware('auth')->group(function () {
    // Route::prefix('api')->group(function () {
    // });
});
Route::resource('events', EventsController::class)->middleware('auth:sanctum');






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')
;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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