<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    use HasFactory;

    const TIPE_TERMINAL = "TERMINAL";
    const TIPE_CHECKPOINT = "CHECKPOINT";
    CONST TIPE_PUL = "PUL";

    public $fillable = [
        'kode', 'nama', 'alamat', 'kota','provinsi','kecamatan','tipe'
    ];
}
