<?php

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::apiResource("", TenantController::class)->parameters(["" => "tenant"]);
