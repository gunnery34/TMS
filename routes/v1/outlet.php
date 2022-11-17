<?php

use App\Http\Controllers\OutletController;
use App\Http\Controllers\OutletSettingController;
use App\Http\Controllers\OutletGroupController;
use App\Http\Controllers\OutletGroupItemController;
use App\Http\Controllers\OutletItemController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::apiResource("setting", OutletSettingController::class)->parameters(["setting" => "outlet-setting"]);
Route::apiResource("group", OutletGroupController::class)->parameters(["group" => "outlet-group"]);
Route::apiResource("group-item", OutletGroupItemController::class)->parameters(['group-item' => 'outlet-group-item']);
Route::apiResource("item", OutletItemController::class)->parameters(["item" => "outlet-item"]);

Route::apiResource("workspace", WorkspaceController::class);
Route::apiResource("tax", TaxController::class);
Route::apiResource("service", ServiceController::class);
Route::get("/", [OutletController::class, 'index'])->name('outlet.index');
Route::get("/{outlet}", [OutletController::class, 'show'])->name('outlet.show');
