<?php

use App\Http\Controllers\AttachController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\JobController;
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
Route::post('/registration', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::get('', function () {
    return ['status' => 'working'];
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('job', JobController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('complain', ComplainController::class);

    Route::post('/attach', [AttachController::class, 'upload']);
    Route::get('/attach/{id}', [AttachController::class, 'preview']);
    Route::get('/attach/{id}/info', [AttachController::class, 'show']);
    Route::get('/attaches', [AttachController::class, 'index']);
});


/*Route::get('/jobs', [JobController::class, 'index']);
Route::post('/job', [JobController::class, 'store']);
Route::get('/job/{id}', [JobController::class, 'show']);*/
