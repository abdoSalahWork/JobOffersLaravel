<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\postedJobsController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthAdminController::class, 'loginPage'])->name('loginPage');
    Route::post('/admin/login', [AuthAdminController::class, 'login'])->name('admin.login');
});



Route::middleware(['auth', 'superAdmin'])->group(function () {

    Route::get('/home', [AuthAdminController::class, 'index'])->name('index');
    Route::get('/logout', [AuthAdminController::class, 'logOut'])->name('admin.logOut');

    //===============      Skills        ===============//

    // Route::get('/admin/skills', [SkillsController::class, 'index'])->name('admin.skills');
    // Route::get('/admin/skills/add', [SkillsController::class, 'add'])->name('admin.skills.add');
    // Route::post('/admin/skills/store', [SkillsController::class, 'store'])->name('admin.skills.store');
    // Route::put('/admin/skills/update/{id}', [SkillsController::class, 'update'])->name('admin.skills.update');
    // Route::delete('/admin/skills/delete/{id}', [SkillsController::class, 'delete'])->name('admin.skills.delete');

    // Route::get('/admin/skills/categories', [SkillsCategoryController::class, 'index'])->name('admin.skills.categories');
    // Route::post('/admin/skills/category/store', [SkillsCategoryController::class, 'store'])->name('admin.skills.categories.store');
    // Route::put('/admin/skills/category/update/{category_id}', [SkillsCategoryController::class, 'update'])->name('admin.skills.categories.update');
    // Route::delete('/admin/skills/category/delete/{category_id}', [SkillsCategoryController::class, 'delete'])->name('admin.skills.categories.delete');

    // //===============      Services        ===============//

    // Route::get('/admin/services', [ServicesController::class, 'index'])->name('admin.services');
    // Route::get('/admin/services/add', [ServicesController::class, 'add'])->name('admin.services.add');
    // Route::post('/admin/services/store', [ServicesController::class, 'store'])->name('admin.services.store');
    // Route::put('/admin/services/update/{id}', [ServicesController::class, 'update'])->name('admin.services.update');
    // Route::delete('/admin/services/delete/{id}', [ServicesController::class, 'delete'])->name('admin.services.delete');



    // //===============      About        ===============//

    // Route::get('/admin/about', [AboutController::class, 'index'])->name('admin.about');
    // Route::put('/admin/about/update', [AboutController::class, 'update'])->name('admin.about.update');




    // //===============      History        ===============//

    // Route::get('/admin/histories', [HistoriesController::class, 'index'])->name('admin.histories');
    // Route::get('/admin/histories/add', [HistoriesController::class, 'add'])->name('admin.histories.add');
    // Route::post('/admin/histories/store', [HistoriesController::class, 'store'])->name('admin.histories.store');
    // Route::put('/admin/histories/update/{id}', [HistoriesController::class, 'update'])->name('admin.histories.update');
    // Route::delete('/admin/histories/delete/{id}', [HistoriesController::class, 'delete'])->name('admin.histories.delete');

    // Route::get('/admin/history/categories', [HistoryCategoryController::class, 'index'])->name('admin.history.categories');
    // Route::post('/admin/history/category/store', [HistoryCategoryController::class, 'store'])->name('admin.history.categories.store');
    // Route::put('/admin/history/category/update/{category_id}', [HistoryCategoryController::class, 'update'])->name('admin.history.categories.update');
    // Route::delete('/admin/history/category/delete/{category_id}', [HistoryCategoryController::class, 'delete'])->name('admin.history.categories.delete');



    // //===============      Numbers       ===============//

    Route::get('/admin/postedJobs', [postedJobsController::class, 'index'])->name('admin.postedJobs');
    // Route::post('/admin/postedJobs/store', [postedJobsController::class, 'store'])->name('admin.postedJobs.sto');
    Route::put('/admin/postedJobs/status/{id}', [postedJobsController::class, 'status'])->name('admin.postedJobs.status');
    Route::delete('/admin/postedJobs/delete/{id}', [postedJobsController::class, 'delete'])->name('admin.postedJobs.delete');




    // //===============      Products       ===============//

    // Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
    // Route::get('/admin/product/add', [ProductController::class, 'add'])->name('admin.product.add');
    // Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    // Route::put('/admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    // Route::delete('/admin/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');

    // Route::get('/admin/product/categories', [ProductCategoryController::class, 'index'])->name('admin.product.categories');
    // Route::post('/admin/product/category/store', [ProductCategoryController::class, 'store'])->name('admin.product.categories.store');
    // Route::put('/admin/product/category/update/{id}', [ProductCategoryController::class, 'update'])->name('admin.product.categories.update');
    // Route::delete('/admin/product/category/delete/{id}', [ProductCategoryController::class, 'delete'])->name('admin.product.categories.delete');

    // //===============      category       ===============//

    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/admin/category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/admin/category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // //===============      Clints       ===============//

    Route::get('/admin/users', [UserController::class, 'getAllUser'])->name('admin.getAllUsers');
    Route::put('/admin/user/update/{id}', [UserController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('/admin/user/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
    // Route::delete('/admin/user/delete/{id}', [UserController::class, 'block'])->name('admin.user.delete');
    Route::post('/admin/user/shearch', [UserController::class, 'searchUser'])->name('admin.user.search');
    Route::put('/admin/user/active/{id}', [UserController::class, 'activeUser'])->name('admin.user.active');

    // //===============      Companies       ===============//

    // Route::get('/admin/clients', [ClientController::class, 'index'])->name('admin.clients');
    // Route::get('/admin/client/add', [ClientController::class, 'add'])->name('admin.client.add');
    // Route::post('/admin/client/store', [ClientController::class, 'store'])->name('admin.client.store');
    // Route::put('/admin/client/update/{id}', [ClientController::class, 'update'])->name('admin.client.update');
    // Route::delete('/admin/client/delete/{id}', [ClientController::class, 'delete'])->name('admin.client.delete');
});
