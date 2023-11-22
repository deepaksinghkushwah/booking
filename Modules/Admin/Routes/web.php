<?php
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Middleware\AdminUser;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Controllers\PageCategoryController;

Route::prefix('admin')->middleware([AdminUser::class])->group(function() {
    Route::get('/', [Modules\Admin\Http\Controllers\AdminController::class, 'dashboard']);
    Route::get('/dashboard', [Modules\Admin\Http\Controllers\AdminController::class, 'dashboard'])->name("admin-dashboard");
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    
    
    Route::prefix('users')->group(function(){
        Route::get('/',[UserController::class,'index'])->name("users.index");
        
        Route::get('create', [UserController::class,'create'])->name("users.create");
        Route::get('edit/{id}',[UserController::class,'edit'])->name("users.edit");
        
        Route::post('store',[UserController::class,'store'])->name("users.store");
        Route::patch('update/{id}',[UserController::class,'update'])->name("users.update");
        Route::delete('destroy/{id}',[UserController::class,'destroy'])->name("users.destroy");
        
        Route::get('show',[UserController::class,'show'])->name("users.show");
    });
    
    Route::prefix('page-categories')->group(function(){
        Route::get('/',[PageCategoryController::class,'index'])->name("page-categories.index");
        
        Route::get('create', [PageCategoryController::class,'create'])->name("page-categories.create");
        Route::get('edit/{id}',[PageCategoryController::class,'edit'])->name("page-categories.edit");
        
        Route::post('store',[PageCategoryController::class,'store'])->name("page-categories.store");
        Route::patch('update/{id}',[PageCategoryController::class,'update'])->name("page-categories.update");
        Route::delete('destroy/{id}',[PageCategoryController::class,'destroy'])->name("page-categories.destroy");
        
        Route::get('show',[PageCategoryController::class,'show'])->name("page-categories.show");
    });
});
