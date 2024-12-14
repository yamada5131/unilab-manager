<?php

use App\Http\Controllers\SendCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// routes/api.php

Route::post('/send-command/{agentId}', [SendCommand::class, 'sendCommand']);
