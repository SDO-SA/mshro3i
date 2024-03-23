<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return view('welcome');
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/departments/{college}', [DepartmentController::class, 'getDepartment']);

Route::prefix('groups')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/create-group', [GroupController::class, 'createForm'])->name('creategroup');
        Route::post('/create-group', [GroupController::class, 'createNewGroup']);
        Route::get('/browse-list', [GroupController::class, 'list'])->name('browsegroup');
        Route::get('/my-group', [GroupController::class, 'show'])->name('mygroup');
        Route::post('/join-group/{group_id}', [GroupController::class, 'joinGroup'])->name('joingroup');
        Route::post('/leave-group', [GroupController::class, 'leaveGroup'])->name('leaveGroup');
    });

Route::prefix('users')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/me', [UserController::class, 'me'])->name('me');
    });

Route::prefix('project')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/create-project', [ProjectController::class, 'createForm'])->name('createproject');
        Route::post('/create-project', [ProjectController::class, 'createProject']);
    });

require __DIR__.'/auth.php';
