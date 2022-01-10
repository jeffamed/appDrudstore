<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['created', 'total_format', 'subtotal_format', 'discount_format', 'cliente'];

    public function details()
    {
        return $this->hasMany(SaleDetails::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
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
        $date = Carbon::parse($this->created_at)->locale('es');
        return $date->isoFormat('D/MMM/Y');
    }

    public function getClienteAttribute()
    {
        return $this->customer->name.' '.$this->customer->last_name;
    }
}
