<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        "package_item_id",
        "item_id",
        "quantity",
    ];

    protected $casts = [
        "package_item_id" => "int",
        "item_id" => "int",
        "quantity" => "int",
    ];

    public function packageItem()
    {
        return $this->belongsTo(Item::class, "package_item_id", "id");
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
