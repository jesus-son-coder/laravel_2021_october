<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Learning\AjaxController;
use App\Http\Controllers\Learning\LearningController;
use App\Http\Controllers\Learning\JavaScriptController;

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

Route::get('/hello', [LearningController::class,'index'])->name('learningHello');

Route::get('/learning/show/{name}', [LearningController::class,'show'])->name('learningUsershow');


/* Ajax with Laravel */
Route::get('add-post', [AjaxController::class, 'myPost']);
Route::post('submit-post', [AjaxController::class, 'submitPost'])->name('postSubmit');

// Radio button checked event :
Route::get('radio-button-lesson', [JavaScriptController::class, 'radioButton']);

/* PHP UNIT YouTube - Ivoir Dev Academy: */
Route::group(['middleware' => 'guest'], function() {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('loginSend');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/contacts', [ContactsController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');
});





/* Fin Ivoir Dev Academy */
