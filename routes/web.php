<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('groups')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/create-group', [GroupController::class, 'create'])->name('creategroup');
        Route::post('/create-group', [GroupController::class, 'CreateNewGroup']);
        Route::get('/browse-list', [GroupController::class, 'list']);
        Route::get('/my-group', [GroupController::class, 'show'])->name('mygroup');
    });

Route::prefix('users')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/me', [UserController::class, 'me'])->name('me');
    });

require __DIR__.'/auth.php';
