<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code",
        "is_active",
    ];

    public $casts = [
        "is_active" => "bool",
    ];

    public function item()
    {
        $this->hasMany(Item::class);
    }
}
