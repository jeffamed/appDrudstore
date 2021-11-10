<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function usages()
    {
        return $this->belongsToMany(Usage::class);
    }

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }

    public function detailSale()
    {
        return $this->hasMany(SaleDetails::class);
    }

    public function detailOrder()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
