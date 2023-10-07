<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WhatsApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// token de acceso 
// EAAOUp21BcMwBO3sOqw1PGmrjXiQcQWDKZCN1o0JuT0de1VSZCre5ZB2HHrjtK9BZAY9JWBurr0cGYaB9Gfh31TIIJmG5fqypCVXiLD2dvGzJZBfb2oIEiki7ZACKYKkOdHYE0ieeHLNJtx6g8xqEv4SqfgWkWpZAPt4yi0eiELRf7B9FYgalqgyRZBwK9FkXOO9y4Lt3StHIX1mQVVIhyjoXfBs05WLYZBSQXsmNqGsYZD

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/prueba',[RegisterController::class,'prueba']);

Route::post('/whatsapp/sendMessage',[WhatsApp::class,'sendMessage']);

Route::get('/whatsapp/verifyToken',[WhatsApp::class,'verifyToken']);

Route::post('/whatsapp/receivedMessage',[WhatsApp::class,'ReceivedMessge']);