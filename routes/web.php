<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExportacionesController;
use App\Http\Controllers\Page\Home;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\Planes\CategoriasController;
use App\Http\Controllers\Planes\PlanesController;
use App\Http\Controllers\Planes\PreciosController;
use App\Http\Controllers\PrivilegiosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/',[Home::class, 'index'])->name('inicio');
Route::get('acerca',[Home::class, 'nosotros'])->name('acerca');
Route::get('contacto',[Home::class, 'contacto'])->name('contacto');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('/registro',[LoginController::class,'registro'])->name('registro');
Route::post('/auth/register', [LoginController::class, 'register'])->name('auth.register')->middleware('guest');
Route::get('/email/verify/{id}/{hash}', [LoginController::class, 'verify'])->name('verification.verify')->middleware('signed');
Route::post('/auth/password/reset', [LoginController::class, 'sendResetLinkEmail'])->name('auth.password.reset'); 
Route::get('/password/reset/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/auth/password/reset/process', [LoginController::class, 'resetPassword'])->name('auth.password.reset.process');
Route::post('/validarLogin', [LoginController::class, 'validarLogin'])->name('validarLogin');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//Gestion de planes
Route::resource('categorias',CategoriasController::class)->parameters(['categorias' => 'categorias'])->names('categorias')->middleware('checkRole:1');
Route::resource('plan',PlanesController::class)->parameters(['plan' => 'plan'])->names('plan')->middleware('checkRole:2');
Route::post('/nuevascondiciones', [PlanesController::class, 'nuevascondiciones'])->name('plan.nuevascondiciones')->middleware('checkRole:2');
Route::delete('/plan/destroycon/{id}', [PlanesController::class, 'destroycon'])->name('plan.destroycon')->middleware('checkRole:2');
Route::resource('precios',PreciosController::class)->parameters(['precios' => 'precios'])->names('precios')->middleware('checkRole:3');

//Gestion de usuarios
Route::resource('roles',RolesController::class)->parameters(['roles' => 'roles'])->names('roles')->middleware('checkRole:9');
Route::resource('privilegios',PrivilegiosController::class)->parameters(['privilegios' => 'privilegios'])->names('privilegios')->middleware('checkRole:11');
Route::resource('/permisos',PermisosController::class)->parameters(['permisos'=>'permisos'])->names('permisos')->middleware('checkRole:12');
Route::resource('/usuarios',UsersController::class)->parameters(['usuarios'=>'usuarios'])->names('usuarios')->middleware('checkRole:10');
Route::delete('/usuarios/destroyroles/{id}', [UsersController::class, 'destroyroles'])->name('usuarios.destroyroles')->middleware('checkRole:10');
Route::get('/exportaciones/pdf/{colaboradores}', [ExportacionesController::class, 'pdf'])->name('exportaciones.pdf')->middleware('auth');

Route::get('/error403',[AdminController::class,'error403'])->name('error403');