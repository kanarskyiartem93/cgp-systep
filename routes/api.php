<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\FieldsForForms\ClientIndexController;
use App\Http\Controllers\Api\FieldsForForms\CompanyIndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/companies', [CompanyController::class, 'index']);
    Route::get('/clients/{company}', [CompanyController::class, 'showClientsBelongToCompany']);
    Route::get('/client_companies/{client}', [CompanyController::class, 'showCompaniesBelongToClient']);
});

Route::get('/companiesForm', [CompanyIndexController::class, 'index'])->name('companyIndexForm');
Route::get('/clientsForm', [ClientIndexController::class, 'index'])->name('clientIndexForm');
