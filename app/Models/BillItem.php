<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "local_id",
        "bill_id",
        "item_id",
        "is_void",
        "void_description",
        "ignore_discount",
        "ignore_tax",
        "ignore_service",
        "discount_value",
        "price",
        "quantity",
        "print_note",
        "promo_id",
        "promo_amount",
    ];

    protected $casts = [
        "local_id" => "int",
        "bill_id" => "int",
        "item_id" => "int",
        "is_void" => "bool",
        "ignore_discount" => "bool",
        "ignore_tax" => "bool",
        "ignore_service" => "bool",
        "discount_value" => "float",
        "price" => "float",
        "quantity" => "int",
        "promo_id" => "int",
        "promo_amount" => "float",
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
