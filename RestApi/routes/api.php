<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 
// Route::get('rest', function (){
//     echo "hello  get";
// });
Route::post('/rest/store', [RestController::class , 'store']);
Route::get('/rest', [RestController::class , 'index']);
Route::put('/rest/update/{id}', [RestController::class , 'update']);
Route::delete('/rest/delete/{id}', [RestController::class , 'destroy']);

Route::post('/login', [RestController::class , 'login']);
Route::put('/reg', [RestController::class , 'register']);
Route::apiResource('ajaxx',RestController::class);





