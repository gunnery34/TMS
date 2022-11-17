<?php

namespace App\Models;

use App\Enums\ItemType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "price",
        "alternative_price",
        "can_direct_buy",
        "can_discount",
        "free_dips",
        "free_flavor",
        "ignored",
        "sku",
        "type",
        "base_price",
        "printer_list",
        "summary_id",
        "category_id",
        "tax_id",
        "service_id",
    ];

    protected $casts = [
        "price" => "float",
        "alternative_price" => "float",
        "can_direct_buy" => "bool",
        "can_discount" => "bool",
        "ignored" => "bool",
        "summary_id " => "int",
        "category_id " => "int",
        "type" => ItemType::class,
        "base_price" => "float",
    ];

    public function summary()
    {
        return $this->belongsTo(Summary::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function itemTax()
    {
        return $this->belongsTo(Tax::class, 'tax_id');
    }

    public function itemService()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function packages()
    {
        return $this->hasMany(ItemPackage::class);
    }

    public function dips()
    {
        return $this->hasMany(Dip::class);
    }

    public function flavors()
    {
        return $this->hasMany(Flavor::class);
    }
}
