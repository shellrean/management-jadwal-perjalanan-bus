<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    public const NGY = "NGY"; // Not Going Yet
    public const OTW = "OTW"; // On The Way
    public const AAD = "AAD"; // Arrival At Destination
    public const CANCEL = "CANCEL";

    protected  $guarded = [];
}
