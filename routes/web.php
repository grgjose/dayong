<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ExcelCollectionController;
use App\Http\Controllers\ExcelNewSalesController;
use App\Http\Controllers\FidelityController;
use App\Http\Controllers\NewSalesController;
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
Route::post('/entries/import', [EntryController::class, 'import']);
Route::get('/entries/view/{id}', [EntryController::class, 'viewDetails']);
Route::get('/entries/edit/{id}', [EntryController::class, 'editDetails']);
Route::get('/entries/getIncentivesMatrix/{id}/{program_id?}', [EntryController::class, 'getIncentivesMatrix']);

Route::get('/new-sales', [NewSalesController::class, 'index']);
Route::post('/new-sales/store', [NewSalesController::class, 'store']);
Route::put('/new-sales/update/{id}', [NewSalesController::class, 'update']);
Route::post('/new-sales/destroy', [NewSalesController::class, 'destroy']);
Route::post('/new-sales/upload', [NewSalesController::class, 'upload']);
Route::post('/new-sales/import', [NewSalesController::class, 'import']);
Route::get('/new-sales/view/{id}', [NewSalesController::class, 'viewDetails']);
Route::get('/new-sales/edit/{id}', [NewSalesController::class, 'editDetails']);
Route::get('/new-sales/print/{id}', [NewSalesController::class, 'print']);

Route::get('/members', [MemberController::class, 'index']);
Route::post('/members/store', [MemberController::class, 'store']);
Route::put('/members/update/{id}', [MemberController::class, 'update']);
Route::post('/members/destroy', [MemberController::class, 'destroy']);
Route::post('/members/upload', [MemberController::class, 'upload']);
Route::post('/members/loadSheets', [MemberController::class, 'loadSheets']);
Route::get('/members/view/{id}', [MemberController::class, 'viewDetails']);
Route::get('/members/edit/{id}', [MemberController::class, 'editDetails']);
Route::get('/members/print/{id}', [MemberController::class, 'print']);

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

Route::get('/excel-collection', [ExcelCollectionController::class, 'index']);
Route::get('/excel-collection/retrieve', [ExcelCollectionController::class, 'retrieve']);
Route::post('/excel-collection/upload', [ExcelCollectionController::class, 'upload']);
Route::post('/excel-collection/loadSheets', [ExcelCollectionController::class, 'loadSheets']);
Route::get('/excel-collection/view/{id}', [ExcelCollectionController::class, 'viewDetails']);
Route::get('/excel-collection/edit/{id}', [ExcelCollectionController::class, 'editDetails']);
Route::put('/excel-collection/update/{id}', [ExcelCollectionController::class, 'update']);
Route::post('/excel-collection/destroy', [ExcelCollectionController::class, 'destroy']);

Route::get('/excel-new-sales', [ExcelNewSalesController::class, 'index']);
Route::get('/excel-new-sales/retrieve', [ExcelNewSalesController::class, 'retrieve']);
Route::post('/excel-new-sales/upload', [ExcelNewSalesController::class, 'upload']);
Route::post('/excel-new-sales/loadSheets', [ExcelNewSalesController::class, 'loadSheets']);
Route::get('/excel-new-sales/view/{id}', [ExcelNewSalesController::class, 'viewDetails']);
Route::get('/excel-new-sales/edit/{id}', [ExcelNewSalesController::class, 'editDetails']);
Route::put('/excel-new-sales/update/{id}', [ExcelNewSalesController::class, 'update']);
Route::post('/excel-new-sales/destroy', [ExcelNewSalesController::class, 'destroy']);
