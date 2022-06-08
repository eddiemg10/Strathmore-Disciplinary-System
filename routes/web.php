<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AccountSelectController;


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

Route::get('/dashboard', function () {

    $user = Auth::user();

    return view('dashboard', ['user' => $user]);
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function(){

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/accountselect', [AccountSelectController::class, 'selectAccount']);

    Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function(){

        Route::get('students', function () {
            return view('admin.parents');
        })->name('admin');
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
