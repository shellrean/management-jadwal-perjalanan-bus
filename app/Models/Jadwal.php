<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    public const NGY = "NGY";
    public const OTW = "OTW";
    public const AAD = "AAD";
    public const CANCEL = "CANCEL";

    protected  $guarded = [];
}
