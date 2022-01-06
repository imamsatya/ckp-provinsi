<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\CkpController;
use App\Http\Controllers\AuthenticationController;
 
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
//tadinya auth:api
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Sanctum
Route::post('/create-account', [AuthenticationController::class, 'createAccount']);
//login user
Route::post('/signin', [AuthenticationController::class, 'signin']);
//using middleware
// Route::prefix('v1')->group
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::post('/sign-out', [AuthenticationController::class, 'logout']);


    //Data
    Route::get('/ckpratarata', [CkpController::class, 'getRatarata']);
    Route::get('/ckp', [CkpController::class, 'index']);

    Route::post('/submitckp', [CkpController::class, 'store']);
    Route::post('/submitrealisasi', [CkpController::class, 'storeRealisasi']);
});



