<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\SandarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CetakController;
use App\Events\KapalEvent;
use App\Models\Sandar;
use App\Models\User;
use App\Models\Role;

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

Route::get('/',[DashboardController::class,'index'])->name('index');
Route::get('/2',[DashboardController::class,'index2'])->name('index2');

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);


Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/dashboard',[SandarController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/test-cetak',[CetakController::class,'cetak'])->name('admin.cetak');

    Route::prefix('kapal')->group(function(){
        // get method
        Route::get('/',[KapalController::class,'index'])->name('admin.kapal.index');
        Route::get('/create',[KapalController::class,'create'])->name('admin.kapal.create');
        Route::get('/edit/{id}',[KapalController::class,'edit'])->name('admin.kapal.edit');
        Route::get('/detail/{id}',[KapalController::class,'detail'])->name('admin.kapal.detail');
        Route::get('/history/',[KapalController::class,'history'])->name('admin.kapal.history');
        Route::get('/history/detail/{id}',[KapalController::class,'history_detail'])->name('admin.kapal.history.detail');
        // post method
        Route::post('/store',[KapalController::class,'store'])->name('admin.kapal.store');
        Route::post('/update/{id}',[KapalController::class,'update'])->name('admin.kapal.update');
        Route::post('/delete/{id}',[KapalController::class,'delete'])->name('admin.kapal.delete');
        Route::post('/restore/{id}',[KapalController::class,'restore'])->name('admin.kapal.restore');
        Route::post('/destroy/{id}',[KapalController::class,'destroy'])->name('admin.kapal.destroy');
    });
    Route::prefix('sandar')->group(function(){
        // get method
        Route::get('/',[SandarController::class,'index'])->name('admin.sandar.index');
        Route::get('/create',[SandarController::class,'create'])->name('admin.sandar.create');
        Route::get('/edit/{id}',[SandarController::class,'edit'])->name('admin.sandar.edit');
        Route::get('/detail/{id}',[SandarController::class,'detail'])->name('admin.sandar.detail');
        Route::get('/history/',[SandarController::class,'history'])->name('admin.sandar.history');
        Route::get('/history/detail/{id}',[SandarController::class,'history_detail'])->name('admin.sandar.history.detail');
        // post method
        Route::post('/store',[SandarController::class,'store'])->name('admin.sandar.store');
        Route::post('/update/{id}',[SandarController::class,'update'])->name('admin.sandar.update');
        Route::post('/delete/{id}',[SandarController::class,'delete'])->name('admin.sandar.delete');
        Route::post('/restore/{id}',[SandarController::class,'restore'])->name('admin.sandar.restore');
        Route::post('/destroy/{id}',[SandarController::class,'destroy'])->name('admin.sandar.destroy');
        Route::post('/setketerangan',[SandarController::class,'setketerangan'])->name('admin.sandar.keterangan');
    });

    Route::prefix('user')->middleware('role:superadmin')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('user.index');
        Route::post('/store',[UserController::class,'store'])->name('user.store');
        Route::post('/update',[UserController::class,'update'])->name('user.update');
        Route::post('/delete/{id}',[UserController::class,'delete'])->name('user.delete');
        
        Route::get('/history',[UserController::class,'history'])->name('user.history');
        Route::post('/restore/{id}',[UserController::class,'restore'])->name('user.restore');
        Route::post('/destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');
    });
    
    Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
    Route::post('/profile/update',[UserController::class,'profile_update'])->name('user.profile.update');
    
    
});
