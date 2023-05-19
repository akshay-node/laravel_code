<?php

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



route::get('/logins',[SignUpController::class,'login_view'])->name('logins');
route::post('/logins',[SignUpController::class,'login']);

route::get('/registers',[SignUpController::class,'register_view'])->name('registers');
route::post('/registers',[SignUpController::class,'register']);

route::get('/logout',[SignUpController::class,'logout']);
Route::get('/home', [SignUpController::class, 'index'])->name('home');
 
route::get('/resert_password/{token?}',[SignUpController::class,'reset_view']);
route::post('/resert_password',[SignUpController::class,'resertpassword']);

route::get('/forget',[SignUpController::class,'forget_view'])->name('forget');
route::post('/forget',[SignUpController::class,'forget']);

route::get('/date',[SignUpController::class,'date']);
