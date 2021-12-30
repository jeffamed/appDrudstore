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

    protected $appends = ['created', 'total_format', 'subtotal_format', 'discount_format', 'proveedor'];

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

    public function getTotalFormatAttribute()
    {
        return number_format($this->total, 2);
    }

    public function getSubtotalFormatAttribute()
    {
        return number_format($this->subtotal, 2);
    }

    public function getDiscountFormatAttribute()
    {
        return number_format($this->discount, 2);
    }

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/M/Y');
    }

    public function getProveedorAttribute()
    {
        return $this->supplier->name;
    }
}
