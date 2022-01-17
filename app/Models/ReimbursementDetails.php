<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function reimbursement()
    {
        return $this->belongsTo(Reimbursement::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
