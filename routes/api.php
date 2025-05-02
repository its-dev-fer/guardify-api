<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\PlansController;

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

Route::post('/tenants/register', [TenantController::class, 'registerTenant']);

Route::post('/users/register-admin', [UserController::class, 'RegisterResidentialAdmin']);

Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
Route::post('/stripe/webhook', [SubscriptionController::class, 'webhook']);

Route::get('/users/admin/register-access', [AccessController::class, 'RegisterAdminAuth']);

Route::get('/plans', [PlansController::class, 'getPlans']);

Route::get('/plans/index/{nombre}', [PlansController::class, 'getPlan']);
