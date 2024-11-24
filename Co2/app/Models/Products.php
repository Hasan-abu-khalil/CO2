<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'unit'];


    public function percentages()
    {
        return $this->hasMany(Percentages::class);
    }

    public function co2()
    {
        return $this->hasMany(Co2::class);
    }

}
