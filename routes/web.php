<?php


use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth', 'manager'])->prefix('manager')->group(function () {
    Route::get('/', [ManagerController::class, 'index'])->name('manager.index');

    Route::group(['namespace' => 'App\Http\Controllers\Manager', 'prefix' => 'posts'], function () {
        Route::get('/', [ManagerController::class, 'posts'])->name('manager.post.index');
        Route::get('/create', [ManagerController::class, 'createPost'])->name('manager.post.create');
        Route::post('/', [ManagerController::class, 'storePost'])->name('manager.post.store');
        Route::get('/{post}', [ManagerController::class, 'showPost'])->name('manager.post.show');
        Route::get('/{post}/edit', [ManagerController::class, 'editPost'])->name('manager.post.edit');
        Route::patch('/{post}', [ManagerController::class, 'updatePost'])->name('manager.post.update');
        Route::delete('/{post}', [ManagerController::class, 'deletePost'])->name('manager.post.delete');
    });

    Route::group(['namespace' => 'App\Http\Controllers\Manager', 'prefix' => 'categories'], function () {
        Route::get('/', [ManagerController::class, 'categories'])->name('manager.category.index');
        Route::get('/create', [ManagerController::class, 'createCategory'])->name('manager.category.create');
        Route::post('/', [ManagerController::class, 'storeCategory'])->name('manager.category.store');
        Route::get('/{category}', [ManagerController::class, 'showCategory'])->name('manager.category.show');
        Route::get('/{category}/edit', [ManagerController::class, 'editCategory'])->name('manager.category.edit');
        Route::patch('/{category}', [ManagerController::class, 'updateCategory'])->name('manager.category.update');
        Route::delete('/{category}', [ManagerController::class, 'deleteCategory'])->name('manager.category.delete');
    });

    Route::group(['namespace' => 'App\Http\Controllers\Manager','prefix' => 'employees'], function () {
        Route::get('/', [ManagerController::class, 'employees'])->name('manager.employee.index');
        Route::get('/create', [ManagerController::class, 'createEmployee'])->name('manager.employee.create');
        Route::post('/', [ManagerController::class, 'storeEmployee'])->name('manager.employee.store');
        Route::get('/{employee}', [ManagerController::class, 'showEmployee'])->name('manager.employee.show');
        Route::get('/{employee}/edit', [ManagerController::class, 'editEmployee'])->name('manager.employee.edit');
        Route::patch('/{employee}', [ManagerController::class, 'updateEmployee'])->name('manager.employee.update');
        Route::delete('/{employee}', [ManagerController::class, 'deleteEmployee'])->name('manager.employee.delete');
    });
});

Route::middleware(['auth', 'employee'])->prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');

    Route::group(['namespace' => 'App\Http\Controllers\Employee', 'prefix' => 'posts'], function () {
        Route::get('/', [EmployeeController::class, 'posts'])->name('employee.post.index');
        Route::get('/create', [EmployeeController::class, 'createPost'])->name('employee.post.create');
        Route::post('/', [EmployeeController::class, 'storePost'])->name('employee.post.store');
        Route::get('/{post}', [EmployeeController::class, 'showPost'])->name('employee.post.show');
        Route::get('/{post}/edit', [EmployeeController::class, 'editPost'])->name('employee.post.edit');
        Route::patch('/{post}', [EmployeeController::class, 'updatePost'])->name('employee.post.update');
        Route::delete('/{post}', [EmployeeController::class, 'deletePost'])->name('employee.post.delete');
    });

    Route::group(['namespace' => 'App\Http\Controllers\Employee', 'prefix' => 'categories'], function () {
        Route::get('/', [EmployeeController::class, 'categories'])->name('employee.category.index');
        });


});

Auth::routes();

