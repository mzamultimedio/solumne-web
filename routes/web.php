<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiChatController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CursoController as StudentCursoController;
use App\Http\Controllers\Student\LeccionController as StudentLeccionController;
use App\Http\Controllers\Student\ExamController as StudentExamController;
use App\Http\Controllers\Student\InvoiceController as StudentInvoiceController;
use App\Http\Controllers\InvoicePdfController;

// SECCIÓN 1: Rutas Públicas
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/downloads', [PageController::class, 'downloads'])->name('downloads.index');
Route::get('/recurso/{filename}', [PageController::class, 'downloadFile'])->name('resource.download');
Route::get('/sedes', [PageController::class, 'sedes'])->name('sedes.index'); // <-- AÑADIR ESTA LÍNEA


// SECCIÓN 2: Rutas de Autenticación
Route::get('/dashboard', RedirectController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// SECCIÓN 3: RUTAS DEL ALUMNO
Route::middleware(['auth'])->prefix('mis-cursos')->name('student.')->group(function () {
    Route::get('/', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/cursos', [StudentCursoController::class, 'index'])->name('cursos.index');
    Route::get('/curso/{curso:slug}', [StudentCursoController::class, 'show'])->name('curso.show');
    Route::get('/leccion/{leccion}', [StudentLeccionController::class, 'show'])->name('leccion.show');
    Route::post('/leccion/{leccion}/complete', [StudentLeccionController::class, 'complete'])->name('leccion.complete');
    Route::get('/modulo/{modulo}/examen', [StudentExamController::class, 'show'])->name('modulo.exam.show');
    Route::post('/modulo/{modulo}/examen', [StudentExamController::class, 'submit'])->name('modulo.exam.submit');
    Route::get('/facturas', [StudentInvoiceController::class, 'index'])->name('invoices.index');
});

// SECCIÓN 3.5: RUTAS DE ADMINISTRACIÓN (Solo admin y gestor)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::post('user/{user}/enroll', [\App\Http\Controllers\Admin\UserController::class, 'enrollCourse'])->name('user.enroll');
    Route::post('user/{user}/unenroll', [\App\Http\Controllers\Admin\UserController::class, 'unenrollCourse'])->name('user.unenroll');
});

// SECCIÓN 4: Archivo de autenticación de Breeze
require __DIR__ . '/auth.php';

// Asistente IA público
Route::post('/ai/chat', AiChatController::class)->middleware('web')->name('ai.chat');

Route::middleware('auth')->group(function () {
    Route::get('/facturas/{invoice}/pdf', InvoicePdfController::class)->name('invoices.pdf');
});
