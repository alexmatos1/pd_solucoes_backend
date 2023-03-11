<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SquadController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/squad', [SquadController::class, 'listSquad']);
Route::post('/squad', [SquadController::class, 'addSquad']);

Route::post('/employee', [EmployeeController::class, 'addEmployee']);
Route::get('/employee', [EmployeeController::class, 'listEmployee']);
Route::post('/squadTime/{id}', [EmployeeController::class, 'squadTime']);
Route::post('/employeeTime', [EmployeeController::class, 'employeeTime']);

Route::post('/report', [ReportController::class, 'addReport']);
Route::post('/reportList/{id}/{dataInicio}/{dataFim}', [ReportController::class, 'listReport']);
