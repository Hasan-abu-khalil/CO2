<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Co2 extends Model
{
    use HasFactory;

    protected $fillable = ['percentage_id', 'product_id', 'amount', 'unit'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function percentage()
    {
        return $this->belongsTo(Percentages::class); // Make sure this is percentage_id
    }



}
