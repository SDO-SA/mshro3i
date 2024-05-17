<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SubmissionController;
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

Route::get('/portal', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return view('portal');
    }
})->name('portal');

Route::get('/committeeportal', function () {
    return redirect('/committee');
})->name('committeeportal');

Route::get('/supervisorportal', function () {
    return redirect('/supervisor');
})->name('supervisorportal');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/announcement/{id}', [AnnouncementController::class, 'show'])->name('showannouncement');
    Route::get('/calendar', [AssignmentController::class, 'calendar'])->name('components.calendar');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/departments/{college}', [DepartmentController::class, 'getDepartment']);

Route::prefix('assignments')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('', [AssignmentController::class, 'index'])->name('assignments.index');
        Route::get('{id}', [AssignmentController::class, 'show'])->name('assignments.show');
        Route::get('submit/{id}', [SubmissionController::class, 'form'])->name('assignments.form');
        Route::post('submit/{id}', [SubmissionController::class, 'submit'])->name('assignments.submit');
    });

Route::prefix('resources')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('', [ResourceController::class, 'index'])->name('resources.index');
        Route::get('{id}', [ResourceController::class, 'show'])->name('resources.show');
    });

Route::prefix('groups')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/create-group', [GroupController::class, 'createForm'])->name('creategroup');
        Route::post('/create-group', [GroupController::class, 'createNewGroup']);
        Route::get('/browse-list', [GroupController::class, 'list'])->name('browsegroup');
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
        Route::get('/update-project/{project_id}', [ProjectController::class, 'updateForm']);
        Route::post('/update-project/{project_id}', [ProjectController::class, 'updateproject'])->name('updateproject');
    });

require __DIR__.'/auth.php';
