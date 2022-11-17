<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        "start_time",
        "end_time",
        "session_code",
        "need_reverse_calculation",
        "outlet_id",
        "start_bill_num",
        "end_bill_num",
        "started_by",
        "ended_by",
        "status",
    ];

    protected $casts = [
        "start_time" => "datetime",
        "end_time" => "datetime",
        "need_reverse_calculation" => "bool",
        "outlet_id" => "int",
        "start_bill_num" => "int",
        "end_bill_num" => "int",
        "started_by" => "int",
        "ended_by" => "int",
        "status" => "int",
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
