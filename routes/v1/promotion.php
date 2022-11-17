<?php

use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PromotionDetailController;
use App\Http\Controllers\PromotionOutletController;
use App\Http\Controllers\PromotionItemController;
use Illuminate\Support\Facades\Route;

Route::apiResource("detail", PromotionDetailController::class)->parameters(["detail" => "promotion-detail"]);

Route::prefix("outlet/{promotion}")->name("outlet.")->group(function () {
    Route::get("", [PromotionOutletController::class, "index"])->name("index");
    Route::get("/search", [PromotionOutletController::class, "search"])->name("search");
    Route::post("", [PromotionOutletController::class, "store"])->name("store");
    Route::delete("/{outlet}", [PromotionOutletController::class, "destroy"])->name("destroy");
});

Route::apiResource("item", PromotionItemController::class)->parameters(["item" => "promotion-item"]);

Route::apiResource("", PromotionController::class)->parameters(["" => "promotion"]);
