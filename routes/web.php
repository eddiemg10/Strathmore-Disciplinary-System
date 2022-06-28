<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountSelectController;
use App\Http\Controllers\StaffMemberController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AssignmentController;
use App\Models\StaffMember;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear-flash/{key}', function ($key) {
    session()->forget($key);
});

Route::get('/dashboard', function () {

    $user = Auth::user();

    return view('dashboard', ['user' => $user]);
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function(){

    Route::get('/accountselect', [AccountSelectController::class, 'selectAccount']);

    Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function(){

        Route::get('students', [StudentController::class, 'index'])->name('admin');

        Route::get('students/{id}', [StudentController::class, 'show']);

        Route::get('teachers', [StaffMemberController::class, 'index'])->name('admin.teachers');

        Route::get('teachers/{id}', [StaffMemberController::class, 'show']);

        Route::get('parents', [UserController::class, 'index'])->name('admin.parents');

        Route::get('parents/{id}', [UserController::class, 'show']);

        Route::get('/search-student', [StudentController::class, 'studentSearchAction'])->name('student.action');

        Route::get('/search-parent', [UserController::class, 'parentSearchAction'])->name('parent.action');

        Route::get('/search-teacher', [StaffMemberController::class, 'teacherSearchAction'])->name('teacher.action');

        Route::get('/discipline', [BookingController::class, 'index'])->name('admin.discipline');

        Route::get('/homework', [AssignmentController::class, 'index'])->name('admin.homework');

    });

    Route::group(['prefix' => 'parent', 'middleware' => ['is_parent']], function(){

        Route::get('/', function () {
            return view('parent.index');
        })->name('parent');
    });

    Route::group(['prefix' => 'teacher', 'middleware' => ['is_teacher']], function(){

        Route::get('/', function () {
            return view('teacher.index');
        })->name('teacher');
    });
    
});

require __DIR__.'/auth.php';
