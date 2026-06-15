<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\LanguagesController;
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
Route::get('/mailsend/dashboard', [MailSendController::class, 'index'])->name('dashboard.index');
Route::get('/mailsend/send', [MailSendController::class, 'create'])->name('send.create');

// Companies
Route::prefix('companies')
  ->name('companies.')
  ->group(function () {
    Route::get('/index', [CompaniesController::class, 'index'])->name('index');
    Route::get('/create', [CompaniesController::class, 'create'])->name('create');
    Route::post('/store', [CompaniesController::class, 'store'])->name('store');
    // Route::get('/show{id}',[CompaniesController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CompaniesController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [CompaniesController::class, 'update'])->name('update');
    Route::delete('/{id}', [CompaniesController::class, 'destroy'])->name('destroy');
  });



// Employees
Route::prefix('employees')
  ->name('employees.')
  ->group(function () {
    Route::get('/index', [ProjectsController::class, 'index'])->name('index');
    Route::get('/create', [ProjectsController::class, 'create'])->name('create');
    Route::post('/store', [ProjectsController::class, 'store'])->name('store');
    // Route::get('/show{id}',[ProjectsController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ProjectsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [ProjectsController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProjectsController::class, 'destroy'])->name('destroy');
  });


// Projects
Route::prefix('projects')
  ->name('projects.')
  ->group(function () {
    Route::get('/index', [ProjectsController::class, 'index'])->name('index');
    Route::get('/create', [ProjectsController::class, 'create'])->name('create');
    Route::post('/store', [ProjectsController::class, 'store'])->name('store');
    // Route::get('/show{id}',[ProjectsController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ProjectsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [ProjectsController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProjectsController::class, 'destroy'])->name('destroy');
  });

  // Attendances
Route::prefix('attendances')
  ->name('attendances.')
  ->group(function () {
    Route::get('/index', [AttendancesController::class, 'index'])->name('index');
    Route::get('/create', [AttendancesController::class, 'create'])->name('create');
    Route::post('/store', [AttendancesController::class, 'store'])->name('store');
    Route::get('/show{id}',[AttendancesController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AttendancesController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [AttendancesController::class, 'update'])->name('update');
    Route::delete('/{id}', [AttendancesController::class, 'destroy'])->name('destroy');
  });



// Languages
// Projects
Route::prefix('languages')
  ->name('languages.')
  ->group(function () {
    Route::get('/index', [LanguagesController::class, 'index'])->name('index');
    Route::get('/create', [LanguagesController::class, 'create'])->name('create');
    Route::post('/store', [LanguagesController::class, 'store'])->name('store');
    // Route::get('/show{id}',[LanguagesController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [LanguagesController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [LanguagesController::class, 'update'])->name('update');
    Route::delete('/{id}', [LanguagesController::class, 'destroy'])->name('destroy');
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
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
