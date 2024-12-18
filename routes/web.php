<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CertificateValidationController;
use App\Http\Controllers\CertificationGruopController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/','index');

Route::get('/administrator/certificates',[CertificateController::class,'index'])->name('certificates.index');
Route::get('/administrator/groups',[CertificationGruopController::class,'index'])->name('groups.index');
Route::get('/administrator/logos',[LogoController::class,'index'])->name('logos.index');
Route::get('/administrator/people',[PersonController::class,'index'])->name('people.index');
Route::get('/administrator/templates',[TemplateController::class,'index'])->name('templates.index');
Route::get('/administrator/users',[UserController::class,'index'])->name('users.index');
Route::get('/administrator/dashboard',[AdministratorController::class,'index'])->name('administrator.index');

Route::get('/certificates/validate', [CertificateValidationController::class, 'showValidationForm'])->name('certificates.validate');
Route::post('/certificates/validate', [CertificateValidationController::class, 'validateCertificate'])->name('certificates.validate.process');