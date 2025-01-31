<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ExcelCollectionController;
use App\Http\Controllers\ExcelNewSalesController;
use App\Http\Controllers\FidelityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\MatrixController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
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

Route::get('/', [MainController::class, 'index']);
Route::post('/login', [MainController::class, 'login']);
Route::post('/logout', [MainController::class, 'logout']);
Route::get('/dashboard', [MainController::class, 'dashboard']);
Route::get('/profile', [MainController::class, 'profile']);

Route::get('/entries', [EntryController::class, 'index']);
Route::post('/entries/store', [EntryController::class, 'store']);
Route::put('/entries/update/{id}', [EntryController::class, 'update']);
Route::post('/entries/destroy', [EntryController::class, 'destroy']);
Route::post('/entries/upload', [EntryController::class, 'upload']);
Route::get('/entries/view/{id}', [EntryController::class, 'viewDetails']);
Route::get('/entries/edit/{id}', [EntryController::class, 'editDetails']);
Route::post('/entries/importEntries', [EntryController::class, 'importEntries']);
Route::get('/entries/getIncentivesMatrix/{id}/{program_id?}', [EntryController::class, 'getIncentivesMatrix']);


Route::get('/members', [MemberController::class, 'index']);
Route::post('/members/store', [MemberController::class, 'store']);
Route::put('/members/update/{id}', [MemberController::class, 'update']);
Route::post('/members/destroy', [MemberController::class, 'destroy']);
Route::post('/members/upload', [MemberController::class, 'upload']);
Route::get('/members/view/{id}', [MemberController::class, 'viewDetails']);
Route::get('/members/edit/{id}', [MemberController::class, 'editDetails']);
Route::get('/members/print/{id}', [MemberController::class, 'print']);
Route::post('/members/importMembers', [MemberController::class, 'importMembers']);

Route::get('/audit', [AuditController::class, 'index']);
Route::post('/audit/store', [AuditController::class, 'store']);
Route::put('/audit/update/{id}', [AuditController::class, 'update']);
Route::post('/audit/destroy', [AuditController::class, 'destroy']);

Route::get('/fidelity', [FidelityController::class, 'index']);
Route::post('/fidelity/register', [FidelityController::class, 'register']);
Route::post('/fidelity/store', [FidelityController::class, 'store']);
Route::put('/fidelity/update/{id}', [FidelityController::class, 'update']);
Route::post('/fidelity/destroy', [FidelityController::class, 'destroy']);

Route::get('/reports', [ReportController::class, 'index']);
Route::post('/reports/store', [ReportController::class, 'store']);
Route::put('/reports/update/{id}', [ReportController::class, 'update']);
Route::post('/reports/destroy', [ReportController::class, 'destroy']);
Route::post('/reports/generate', [ReportController::class, 'generate']);

Route::get('/attendance', [AttendanceController::class, 'index']);
Route::post('/attendance/store', [AttendanceController::class, 'store']);
Route::put('/attendance/update/{id}', [AttendanceController::class, 'update']);
Route::post('/attendance/destroy', [AttendanceController::class, 'destroy']);

Route::get('/branch', [BranchController::class, 'index']);
Route::post('/branch/store', [BranchController::class, 'store']);
Route::put('/branch/update/{id}', [BranchController::class, 'update']);
Route::post('/branch/destroy', [BranchController::class, 'destroy']);

Route::get('/program', [ProgramController::class, 'index']);
Route::post('/program/store', [ProgramController::class, 'store']);
Route::put('/program/update/{id}', [ProgramController::class, 'update']);
Route::post('/program/destroy', [ProgramController::class, 'destroy']);

Route::get('/user-accounts', [UserController::class, 'index']);
Route::post('/user-accounts/store', [UserController::class, 'store']);
Route::put('/user-accounts/update/{id}', [UserController::class, 'update']);
Route::post('/user-accounts/destroy', [UserController::class, 'destroy']);
Route::post('/user-accounts/change_pic', [UserController::class, 'change']);

Route::get('/matrix', [MatrixController::class, 'index']);
Route::post('/matrix/store', [MatrixController::class, 'store']);
Route::put('/matrix/update/{id}', [MatrixController::class, 'update']);
Route::post('/matrix/destroy', [MatrixController::class, 'destroy']);
Route::post('/matrix/change_pic', [MatrixController::class, 'change']);

Route::get('/excel-collection', [ExcelCollectionController::class, 'index']);
Route::get('/excel-collection/retrieve', [ExcelCollectionController::class, 'retrieve']);
Route::post('/excel-collection/upload', [ExcelCollectionController::class, 'upload']);
Route::post('/excel-collection/store', [ExcelCollectionController::class, 'store']);
Route::put('/excel-collection/update/{id}', [ExcelCollectionController::class, 'update']);
Route::post('/excel-collection/destroy', [ExcelCollectionController::class, 'destroy']);

Route::get('/excel-new-sales', [ExcelNewSalesController::class, 'index']);
Route::get('/excel-new-sales/retrieve', [ExcelNewSalesController::class, 'retrieve']);
Route::post('/excel-new-sales/upload', [ExcelNewSalesController::class, 'upload']);
Route::post('/excel-new-sales/store', [ExcelNewSalesController::class, 'store']);
Route::put('/excel-new-sales/update/{id}', [ExcelNewSalesController::class, 'update']);
Route::post('/excel-new-sales/destroy', [ExcelNewSalesController::class, 'destroy']);
