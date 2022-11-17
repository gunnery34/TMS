<?php

namespace App\Models;

use App\Enums\BillStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        "local_id",
        "session_id",
        "bill_number",
        "opened_at",
        "opened_by",
        "closed_at",
        "closed_by",
        "table_id",
        "table_name",
        "discount_percent",
        "discount_value",
        "tax_percent",
        "tax_value",
        "service_percent",
        "service_value",
        "extra_price",
        "sub_total",
        "change_total",
        "promotion_discount_total",
        "total",
        "round_value",
        "max_discount",
        "printed_at",
        "first_order_time",
        "last_order_time",
        "last_modified_time",
        "area",
        "ref_num",
        "discount_description",
        "user_phone_number",
        "outlet_id",
        "status",
        "membership_name",
        "membership_role",
        "membership_grade",
        "table_note",
        "void_note",
        "void_by",
        "pax",
        "extra_price_description",
    ];

    protected $casts = [
        "status" => BillStatus::class,
        "opened_at" => "datetime",
        "closed_at" => "datetime",
        "printed_at" => "datetime",
        "first_order_time" => "datetime",
        "last_order_time" => "datetime",
        "last_modified_time" => "datetime",
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
