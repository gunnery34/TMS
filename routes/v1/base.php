<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;

Route::prefix("auth")->name("auth.")->group(base_path("routes/v1/auth.php"));

Route::middleware(["auth.admin"])->group(function () {
    Route::get("user", [AuthController::class, "user"])->name("user");

    Route::name("outlet.")->prefix("outlet")->group(base_path("routes/v1/outlet.php"));
    Route::name("item.")->prefix("item")->group(base_path("routes/v1/item.php"));
    Route::name("promotion.")->prefix("promotion")->group(base_path("routes/v1/promotion.php"));
    Route::name("tenant.")->prefix("tenant")->group(base_path("routes/v1/tenant.php"));
});
