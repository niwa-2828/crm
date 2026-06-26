<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceCorrectionRequestController;
use App\Http\Controllers\AdminAttendanceRequestController;
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

Route::get('/inertia/index', [InertiaController::class, 'index'])->name('inertia.index');
Route::get('/inertia/create', [InertiaController::class, 'create'])->name('inertia.create');
Route::post('/inertia', [InertiaController::class, 'store'])->name('inertia.store');
Route::get('/inertia/show{id}', [InertiaController::class, 'show'])->name('inertia.show');
Route::delete('/inertia/{id}', [InertiaController::class, 'delete'])->name('inertia.delete');



Route::get('/inertia', function () {
  return Inertia::render('Inertia');
});

Route::get(
  '/component-test',
  function () {
    return Inertia::render('ComponentTest');
  }
);

// MailSend
Route::prefix('mailsend')
  ->name('mailsend.')
  ->group(function () {
    Route::get('/', [MailSendController::class, 'index'])->name('index');
    Route::get('/create', [MailSendController::class, 'create'])->name('create');
    Route::post('/confirm', [MailSendController::class, 'confirm'])->name('confirm');
    Route::post('/send', [MailSendController::class, 'send'])->name('send');
  });

// Companies
Route::prefix('companies')
  ->name('companies.')
  ->group(function () {
    Route::get('/index', [CompanyController::class, 'index'])->name('index');
    Route::get('/create', [CompanyController::class, 'create'])->name('create');
    Route::post('/store', [CompanyController::class, 'store'])->name('store');
    // Route::get('/show{id}',[CompanyController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [CompanyController::class, 'update'])->name('update');
    Route::delete('/{id}', [CompanyController::class, 'destroy'])->name('destroy');

    // 会社一覧CSV出力用。URLはハイフンで繋ぐ。メソッド名はキャメル型。
    Route::get('/export-csv', [CompanyController::class, 'exportCsv'])->name('export-csv');

    // 会社一覧PDFをダウンロードするためのルート
    Route::get('/export-pdf', [CompanyController::class, 'exportPdf'])->name('export-pdf');
  });

// Employees
Route::prefix('employees')
  ->name('employees.')
  ->group(function () {
    Route::get('/index', [EmployeeController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    Route::post('/store', [EmployeeController::class, 'store'])->name('store');
    // Route::get('/show{id}',[EmployeeController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
  });


// Projects
Route::prefix('projects')
  ->name('projects.')
  ->group(function () {
    Route::get('/index', [ProjectController::class, 'index'])->name('index');
    Route::get('/create', [ProjectController::class, 'create'])->name('create');
    Route::post('/store', [ProjectController::class, 'store'])->name('store');
    // Route::get('/show{id}',[ProjectController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [ProjectController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('destroy');
  });

// Languages
Route::prefix('languages')
  ->name('languages.')
  ->group(function () {
    Route::get('/index', [LanguageController::class, 'index'])->name('index');
    Route::get('/create', [LanguageController::class, 'create'])->name('create');
    Route::post('/store', [LanguageController::class, 'store'])->name('store');
    // Route::get('/show{id}',[LanguageController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [LanguageController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [LanguageController::class, 'update'])->name('update');
    Route::delete('/{id}', [LanguageController::class, 'destroy'])->name('destroy');
  });

// Attendances
Route::prefix('attendances')
  ->name('attendances.')
  ->group(function () {
    Route::get('/index', [AttendanceController::class, 'index'])->name('index');
    Route::get('/create', [AttendanceController::class, 'create'])->name('create');
    Route::post('/store', [AttendanceController::class, 'store'])->name('store');
    Route::get('/show', [AttendanceController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AttendanceController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [AttendanceController::class, 'update'])->name('update');
    Route::delete('/{id}', [AttendanceController::class, 'destroy'])->name('destroy');
  });

// AttendanceCorrectionRequests
Route::prefix('/attendances/correction-requests')
  ->name('attendances.correction-requests.')
  ->group(function () {
    // Route::get('/index', [AttendanceCorrectionRequestController::class, 'index'])->name('index');
    // Route::get('/create', [AttendanceCorrectionRequestController::class, 'create'])->name('create');
    Route::post('/', [AttendanceCorrectionRequestController::class, 'store'])->name('store');
    // Route::get('/show',[AttendanceCorrectionRequestController::class, 'show'])->name('show');
    // Route::get('/{id}/edit', [AttendanceCorrectionRequestController::class, 'edit'])->name('edit');
    // Route::patch('/{id}', [AttendanceCorrectionRequestController::class, 'update'])->name('update');
    // Route::delete('/{id}', [AttendanceCorrectionRequestController::class, 'destroy'])->name('destroy');
  });

// AdminAttendanceRequests
Route::middleware(['auth', 'admin', 'verified'])
  ->prefix('/admin/attendances')
  ->name('admin.attendances.')
  ->group(function () {
    Route::get('/index', [AdminAttendanceRequestController::class, 'index'])->name('index');
    Route::get('/{id}', [AdminAttendanceRequestController::class, 'show'])->name('show');
    Route::patch('/{id}/approve', [AdminAttendanceRequestController::class, 'approve'])->name('approve');
    Route::patch('/{id}/reject', [AdminAttendanceRequestController::class, 'reject'])->name('reject');
  });


Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard', [
    'authUser' => Auth::user(),
  ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
