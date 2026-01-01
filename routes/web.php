<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Manager\ManagerTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->prefix('admin')->group(function(){
       Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
       Route::get('/user/create', [UserController::class, 'create'])->name('admin.users.create');
       Route::post('/user/store', [UserController::class, 'store'])->name('admin.users.store');
       Route::patch('/user/update/{id}', [UserController::class,'update'])->name('admin.users.update');
       Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
       Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

       Route::get('/tasks', [TaskController::class, 'index'])->name('admin.tasks.index');
       Route::get('/task/create', [TaskController::class, 'create'])->name('admin.tasks.create');
       Route::post('/task/store', [TaskController::class, 'store'])->name('admin.tasks.store');
       Route::patch('/task/update/{id}', [TaskController::class,'update'])->name('admin.tasks.update');
       Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('admin.tasks.edit');
       Route::delete('/task/delete/{id}', [TaskController::class, 'destroy'])->name('admin.tasks.destroy');
    });

    Route::middleware('role:manager')->prefix('manager')
    ->controller(ManagerTaskController::class)->group(function(){
        Route::get('/assign/tasks', 'index')->name('manager.assign.tasks.index');
        Route::get('/assign/task/{id}','assignForm')->name('manager.assign.form');
        Route::post('/assign/task', 'asssignTask')->name('manager.assign.task');
    });

    Route::middleware('role:employee')->prefix('employee')->group(function(){
        Route::get('/assign/your-tasks', [EmployeeController::class, 'index'])->name('employee.your.tasks.index');
        Route::get('/assign/your-task/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.your.tasks.edit');
        Route::post('/assign/your-task/update/{id}', [EmployeeController::class, 'update'])->name('employee.your.tasks.update');
    });
});

require __DIR__.'/auth.php';
