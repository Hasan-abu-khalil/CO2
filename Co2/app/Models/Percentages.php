<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percentages extends Model
{
    use HasFactory;

    protected $fillable = ['source_id', 'product_id', 'amount',];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function source()
    {
        return $this->belongsTo(Sources::class);
    }


    public function co2s()
    {
        return $this->hasMany(Co2::class);
    }
}
