<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoterController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/index', [CandidateController::class, 'index'])->middleware(['verifyEmail', 'login']);;


Route::controller(VoterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login')->middleware('verifyEmail');
    Route::post('/logout', 'logout')->middleware(['verifyEmail', 'login']);
    Route::post('/resend-otp',  'resendOtp');
    Route::post('/otp/verify', 'verify');

    Route::post('/vote/{otp}/{nis}', 'vote')->middleware(['verifyEmail', 'login']);
});