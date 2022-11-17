<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemPackageController;
use App\Http\Controllers\DipController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/package/{idItem}/lists', [ItemPackageController::class, 'index'])->name('package.index');
Route::apiResource("package", ItemPackageController::class)->parameters(["package" => "item-package"])->except(['index']);
Route::apiResource("dip", DipController::class);
Route::apiResource("flavor", FlavorController::class);
Route::apiResource("summary", SummaryController::class);

Route::get("category/search", [CategoryController::class, "search"]);
Route::apiResource("category", CategoryController::class);

Route::get('/items-single', [ItemController::class, 'searchItemSingleType'])->name('single');
Route::apiResource("", ItemController::class)->parameters(["" => "item"]);
