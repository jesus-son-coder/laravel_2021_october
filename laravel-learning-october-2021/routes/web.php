<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Learning\LearningController;
use App\Http\Controllers\Learning\AjaxController;
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

