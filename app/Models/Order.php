<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['created', 'total_format', 'subtotal_format', 'proveedor'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function reimbursement()
    {
        return $this->hasMany(Reimbursement::class);
    }

    public function getTotalFormatAttribute()
    {
        return number_format($this->total, 2);
    }

    public function getSubtotalFormatAttribute()
    {
        return number_format($this->subtotal, 2);
    }

    public function getCreatedAttribute()
    {
        $date = Carbon::parse($this->created_at)->locale('es');
        return $date->isoFormat('D/MMM/Y');
    }

    public function getProveedorAttribute()
    {
        return optional($this->supplier)->name;
    }
}
