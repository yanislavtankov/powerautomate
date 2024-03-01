<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ManageEmailsController;

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
Route::get('/dashboard', [ManageEmailsController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/delete/{id}', [ManageEmailsController::class, 'destroy'])->middleware(['auth'])->name('deltickets');
Route::get('/dashboard/edit/{id}', [ManageEmailsController::class, 'edit'])->middleware(['auth'])->name('edit');
Route::post('/dashboard/update/{id}', [ManageEmailsController::class, 'update'])->middleware(['auth'])->name('update');

require __DIR__.'/auth.php';
