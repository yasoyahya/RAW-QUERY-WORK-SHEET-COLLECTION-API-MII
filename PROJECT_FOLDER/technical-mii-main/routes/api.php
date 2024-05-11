<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\EmployeeFamilyController;
use App\Http\Controllers\EmployeeEducationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// CRUD EMPLOYEE
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

// CRUD EMPLOYEE REPORT
Route::get('/employees-report', [EmployeeController::class, 'report']);


// CRUD EMPLOYEE PROFILE
Route::get('/employees-profile', [EmployeeProfileController::class, 'index']);
Route::post('/employees-profile', [EmployeeProfileController::class, 'store']);
Route::get('/employees-profile/{id}', [EmployeeProfileController::class, 'show']);
Route::put('/employees-profile/{id}', [EmployeeProfileController::class, 'update']);
Route::delete('/employees-profile/{id}', [EmployeeProfileController::class, 'destroy']);

// CRUD EMPLOYEE FAMILY
Route::get('/employees-family', [EmployeeFamilyController::class, 'index']);
Route::post('/employees-family', [EmployeeFamilyController::class, 'store']);
Route::get('/employees-family/{id}', [EmployeeFamilyController::class, 'show']);
Route::put('/employees-family/{id}', [EmployeeFamilyController::class, 'update']);
Route::delete('/employees-family/{id}', [EmployeeFamilyController::class, 'destroy']);

// CRUD EMPLOYEE EDUCATION
Route::get('/employees-education', [EmployeeEducationController::class, 'index']);
Route::post('/employees-education', [EmployeeEducationController::class, 'store']);
Route::get('/employees-education/{id}', [EmployeeEducationController::class, 'show']);
Route::put('/employees-education/{id}', [EmployeeEducationController::class, 'update']);
Route::delete('/employees-education/{id}', [EmployeeEducationController::class, 'destroy']);


