<?php

use App\Http\Controllers\ApplyJobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/////       Authction
Route::group()
Route::post('/register',[AuthController::class, 'register'])->name('register');
Route::get('/getUsers',[AuthController::class, 'index'])->name('getUsers');
Route::post('/logout',[AuthController::class, 'logOut'])->name('logOut');
Route::post('/login',[AuthController::class, 'logIn'])->name('logIn');


///////          Jobs

Route::get('/categoryJobs',[JobController::class, 'getAllCategoryAndJobs'])->name('categories.getAll');
Route::get('/job/jobsByPublisher',[JobController::class, 'jobsByPublisher'])->name('jobsByPublisher');
Route::get('/jobs',[JobController::class, 'index'])->name('jobs.index');
Route::get('/job/details/{jobId}',[JobController::class, 'show'])->name('job.show');
Route::post('/job/store',[JobController::class, 'store'])->name('job.store');
Route::put('/job/update/{id}',[JobController::class, 'update'])->name('job.update');
Route::delete('/job/delete/{id}',[JobController::class, 'delete'])->name('job.delete');
Route::get('/job/search',[JobController::class, 'search'])->name('job.search');


/////           ApplyJob

Route::get('/apply/jobsByUser',[ApplyJobController::class, 'jobsByUser'])->name('GetJobsByUser');
Route::get('/apply/detailsOfJob/{applyId}',[ApplyJobController::class,'detailsOfJob'])->name('detailsOfJob');
// Route::get('/apply/show/{id}',[ApplyForJob::class, 'show'])->name('job.show');
Route::post('/apply/store/{jobId}',[ApplyJobController::class, 'store'])->name('apply.store');
Route::put('/apply/update/{applyId}',[ApplyJobController::class, 'update'])->name('apply.update');
Route::delete('/apply/delete/{id}',[ApplyJobController::class, 'delete'])->name('apply.delete');
