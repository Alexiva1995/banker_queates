<?php

use App\Http\Controllers\ChartsController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\FutswapController;
use App\Http\Controllers\PaymentController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('payment.processor')->group(function(){
    Route::post('/payment_confirmation', [PaymentController::class, 'paymentConfirmation']);
});

Route::post('/rent-chart', [DashboardController::class, 'getRentChart'])->name('get.rent.chart');
Route::post('/days-chart', [DashboardController::class, 'getDaysChart'])->name('get.days.chart');
Route::post('/data-ranges-charts', [DashboardController::class, 'getDataRangesCharts'])->name('get.data.ranges.charts');
//Gráficos para el dashboard del admin
Route::get('/data-sales-chart', [ChartsController::class, 'salesChartData'])->name('get.sales.chart.data');
Route::get('/data-packages-bar-chart', [ChartsController::class, 'packagesBarChart'])->name('get.packages.bar.chart.data');
// Gráficos para el dashboard del usuario
Route::get('/dashboard-bonus-charts/{user_id?}', [ChartsController::class, 'bonusChartsData'])->name('get.bonus.chart.data');
Route::get('/dashboard-profit-packages-chart/{user_id?}', [ChartsController::class, 'profitPackageChartData'])->name('get.package.chart.data');

Route::group(['prefix' => 'inversion'], function () {
    Route::post('/solicitar', [InversionController::class, 'solicitar'])->name('inversion.solicitar');
    Route::post('/cancelar', [InversionController::class, 'cancelar'])->name('solicitud.cancelar');
});
