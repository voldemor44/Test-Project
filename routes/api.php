<?php

use App\Http\Controllers\BasicActionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TypeController;

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


Route::get('/event/allList', [EvenementController::class, 'allEeventlist']);

Route::get('/event/show', [EvenementController::class, 'showEvent']);

Route::post('/event/ajout', [EvenementController::class, 'store']);

Route::post('/event/update', [EvenementController::class, 'update']);

Route::post('/event/type_ticket/ajout', [TypeController::class, 'create_TypeticketEvent']);
Route::post('/event/type_ticket/update', [TypeController::class, 'update_type']);


Route::post('/event/buyTickets', [TicketController::class, 'buyTicket']);
Route::get('/event/scanner/scan-ticket', [TicketController::class, 'scanTicket']);
Route::post('/event/scanner/connection', [ScannerController::class, 'toConnectScanner']);

Route::get('/event/scanner/present_statistique', [ScannerController::class, 'statisticScannerPresent']);
Route::get('/event/all/scanner', [ScannerController::class, 'listEventofScanner']);
Route::get('/event/past/scanner/statistique', [ScannerController::class, 'statisticScannerPastEvent']);
Route::get('/event/scanner/deconnection', [ScannerController::class, 'toDeconnectScanner']);

Route::post('/create-scanner', [ScannerController::class, 'createAnScanner']);

Route::post('/event/assign-scanner', [ScannerController::class, 'assign_scanner_to_event']);

Route::post('/event/scanner/modify-profil', [ScannerController::class, 'modifyProfilScanner']);

Route::post('/event/scanner/modify-password', [ScannerController::class, 'modifyScannerPassword']);

Route::post('/participant/inscription', [BasicActionController::class, 'inscription']);

Route::post('/connection', [BasicActionController::class, 'connectUserOrAdmin']);
