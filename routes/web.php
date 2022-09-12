<?php

use App\Http\Middleware\ActiveUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoiceAttachmentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

require __DIR__ . '/auth.php';


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class)->middleware(ActiveUser::class);
    Route::get('/page/{page}', [AdminController::class, 'index']);
    Route::resource('/dashboard/invoices', InvoicesController::class);
    Route::get('/mark', [InvoicesController::class, "markAzRecord"])->name('markAzRecord');
    Route::resource('/dashboard/section', SectionController::class);
    Route::get('/section/{id}', [InvoicesController::class, 'getProducts']);
    Route::get('/payment-status/{id}', [InvoicesController::class, 'show'])->name('payment-status');
    Route::post('/payment-update/{id}', [InvoicesController::class, 'statusUpdate'])->name('statusUpdate');
    Route::get('/invoice-print/{id}', [InvoicesController::class, 'invoicePrint'])->name('invoicePrint');
    Route::resource('/dashboard/products', ProductController::class);
    Route::resource('/invoice/details', InvoiceDetailController::class);
    Route::resource('/invoice/attachment', InvoiceAttachmentController::class);
    Route::get('/reports/invoice', [ReportsController::class, 'index'])->name('reports.index');
    Route::post('/search/invoice', [ReportsController::class, 'search'])->name('search.invoice');
    Route::get('/reports/user', [ReportsController::class, 'userIndex'])->name('reports.user');
    Route::post('/search/user', [ReportsController::class, 'userSearch'])->name('search.user');
    Route::get('/index', [HomeController::class, 'index'])->name('home');
});
