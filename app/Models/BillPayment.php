<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        "local_id",
        "bill_id",
        "type",
        "card_number",
        "transaction_code",
        "is_full_payment",
        "amount_to_collect",
        "status",
        "printed_at",
    ];

    protected $casts = [
        "local_id" => "int",
        "bill_id" => "int",
        "card_number" => "int",
        "is_full_payment" => "bool",
        "amount_to_collect" => "float",
        "status" => "int",
        "printed_at" => "date",
    ];

    public function bill()
    {
        return $this->belongsTo(Bills::class);
    }
}
