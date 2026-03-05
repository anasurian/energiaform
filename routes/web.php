<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', [LeadController::class, 'index']);
Route::post('/lead', [LeadController::class, 'store'])->name('lead.store');
