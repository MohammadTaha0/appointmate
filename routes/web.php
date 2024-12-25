<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CompanyUserController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\CompanyPageController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\SAMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/storage-link', function () {
    // Define the paths
    $target =base_path('/storage/app/public');
    $link =base_path('/public/storage');

    try {
        // Check if the link already exists
        if (file_exists($link)) {
            echo "The link already exists at: $link";
        } else {
            // Create the symbolic link
            symlink($target, $link);
            echo "The storage link has been created successfully!";
        }
    } catch (Exception $e) {
        // Handle errors
        echo "An error occurred: " . $e->getMessage();
    }
});
Route::middleware(Authenticate::class)->group(function () {
    Route::get('/{company_slug?}', function ($company_slug = null) {
        if (!$company_slug) {
            if (Auth::user()->getCompany) {
                return redirect(url('/' . Str::slug(Auth::user()->getCompany->name) . '/admin'));
            } else {
                return redirect(url('/SA/admin'));
            }
        }
        // echo  Str::slug(Auth::user()->getCompany->name);
        // return redirect(route('admin.dashboard'));
    });
    Route::prefix('{company_slug}/admin')->name('admin.')->group(function ($company_slug) {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::middleware(SAMiddleware::class)->prefix('company')->name('company.')->controller(CompanyController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/updates', 'updates')->name('updates');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/deleteAll', 'deleteAll')->name('deleteAll');
        });
        Route::prefix('company_user')->name('company_user.')->controller(CompanyUserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/updates', 'updates')->name('updates');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/deleteAll', 'deleteAll')->name('deleteAll');
        });
        Route::prefix('service')->name('service.')->controller(ServiceController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/updates', 'updates')->name('updates');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/deleteAll', 'deleteAll')->name('deleteAll');
        });
        Route::prefix('doctor')->name('doctor.')->controller(DoctorController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/updates', 'updates')->name('updates');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/deleteAll', 'deleteAll')->name('deleteAll');
        });
    });
});

Route::prefix('/auth')->controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('attempt', 'attempt')->name('attempt');
    Route::get('logout', 'logout')->name('logout');
});

Route::prefix('{id}/{slug}/company')->name('company.')->controller(CompanyPageController::class)->group(function () {
    Route::get('/', 'page')->name('page');
});

