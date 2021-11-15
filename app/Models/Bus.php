<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    public $fillable = [
        'plat_number', 'bus_number', 'distributor','ukuran'
    ];
}
