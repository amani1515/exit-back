<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;

Route::post('/enrollment/check', [EnrollmentController::class, 'check']);
Route::post('/feedback', [EnrollmentController::class, 'feedback']);
