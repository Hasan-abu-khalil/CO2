<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sources extends Model
{
    use HasFactory;
    protected $fillable = ['name',];

    public function percentages()
    {
        return $this->hasMany(Percentages::class);
    }
}
