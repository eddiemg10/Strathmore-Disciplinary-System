<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountSelectController;
use App\Http\Controllers\StaffMemberController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\BlockedUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ParentStudentController;
use App\Http\Controllers\WarningController;
use App\Models\ParentStudent;
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
})->middleware('role_redirect');

Route::get('/clear-flash/{key}', function ($key) {
    session()->forget($key);
});

Route::get('/dashboard', function () {

    $user = Auth::user();

    return view('dashboard', ['user' => $user]);
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function(){


    Route::get('/accountselect', [AccountSelectController::class, 'selectAccount']);

    Route::get('/student/history', [StudentController::class, 'getStudentHistory'])->name('student.history');

    Route::get('admin/search-student', [StudentController::class, 'studentSearchAction'])->name('student.action');

    Route::get('admin/search-student-name', [StudentController::class, 'getName'])->name('student.name');


    Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function(){

        Route::get('students', [StudentController::class, 'index'])->name('admin');

        Route::post('students', [StudentController::class, 'destroy'])->name('student.delete');

        Route::post('students/update', [StudentController::class, 'update'])->name('student.update');

        Route::get('students/{id}', [StudentController::class, 'show']);

        Route::get('teachers', [StaffMemberController::class, 'index'])->name('admin.teachers');

        Route::get('teachers/{id}', [StaffMemberController::class, 'show']);

        Route::post('teachers/update', [StaffMemberController::class, 'update'])->name('teacher.update');

        Route::get('administrators', [StaffMemberController::class, 'indexAdmins'])->name('admin.admins');

        Route::get('administrators/{id}', [StaffMemberController::class, 'showAdmin']);

        Route::post('parents/update', [UserController::class, 'update'])->name('parent.update');

        Route::get('parents', [UserController::class, 'index'])->name('admin.parents');

        Route::post('parents/students', [ParentStudentController::class, 'store'])->name('parent-student');

        Route::get('parents/{id}', [UserController::class, 'show']);

        Route::post('users', [UserController::class, 'destroy'])->name('user.delete');

        Route::post('users/block', [UserController::class, 'block'])->name('user.block');

        Route::post('users/unblock', [BlockedUserController::class, 'delete'])->name('user.unblock');



        Route::get('/search-parent', [UserController::class, 'parentSearchAction'])->name('parent.action');

        Route::get('/search-teacher', [StaffMemberController::class, 'teacherSearchAction'])->name('teacher.action');

        


    });

    Route::group(['prefix' => 'parent', 'middleware' => ['is_parent']], function(){

        Route::get('/', function () {
            return view('parent.index');
        })->name('parent');

        Route::get('/{id}/discipline', [StudentController::class, 'showStudentRecord'])->middleware('belongs_to_parent')->name('parent.records');
    });

    Route::group(['prefix' => 'teacher', 'middleware' => ['is_teacher']], function(){

        Route::get('/', [BookingController::class, 'index'])->name('teacher');

        // Migrated Routes begin here
        Route::get('/behavioursheet', [BookingController::class, 'index'])->name('admin.behavioursheet');

        Route::get('/behavioursheet/{classroom}', [BookingController::class, 'show'])->name('bs');

        Route::post('/behavioursheet', [BookingController::class, 'store'])->name('book');

        Route::post('/bookings/assess', [BookingController::class, 'assessBookings'])->name('assess.bookings')->middleware('is_senior');

        Route::get('/bookings/edit/{id}', [BookingController::class, 'edit'])->middleware('is_senior');
        
        Route::post('/bookings/edit', [BookingController::class, 'update'])->name('booking.edit')->middleware('is_senior');

        Route::post('/bookings/delete', [BookingController::class, 'destroy'])->name('booking.delete')->middleware('is_senior');

        Route::get('/bookings/unassessed', [BookingController::class, 'showUnassessed'])->middleware('is_senior');

        Route::get('/bookings/assessed', [BookingController::class, 'showAssessed'])->middleware('is_senior');

        Route::get('/detention', [BookingController::class, 'detention'])->name('admin.detention')->middleware('is_senior');

        Route::get('/detentionlist', [BookingController::class, 'createBookingList'])->name('detentionPDF')->middleware('is_senior');

        Route::get('/homework', [AssignmentController::class, 'index'])->name('admin.homework.homework');

        Route::get('/homework/{classroom}', [AssignmentController::class, 'show'])->name('admin.showHomework');

        Route::get('/notify/detention', [NotificationController::class, 'notifyOnDetention'])->name('notify.detention');
        //Migrated Routed end here

        Route::get('/updates', [WarningController::class, 'index'])->name('discipline.updates')->middleware('is_senior');

        Route::post('/updates', [WarningController::class, 'resolve'])->name('discipline.resolve')->middleware('is_senior');

        // Route::get('/history', [BookingController::class, 'showHistory'])->name('discipline.history')->middleware('is_senior');

    });
    
});

require __DIR__.'/auth.php';
