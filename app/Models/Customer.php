<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['full_name'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name." ".$this->last_name;
    }


}
