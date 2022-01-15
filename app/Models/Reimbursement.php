<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reimbursement extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['total_format', 'proveedor'];

    public function details()
    {
        return $this->hasMany(ReimbursementDetails::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTotalFormatAttribute()
    {
        return number_format($this->total, 2);
    }

    public function getProveedorAttribute()
    {
        return $this->supplier->name;
    }

}
