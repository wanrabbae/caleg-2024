<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Saksi extends Model
{
    use HasFactory;
    protected $table = "saksi";
    protected $primaryKey = "nik";
    public $timestamps = false;

    public function relawan() {
        return $this->belongsTo(Relawan::class, "nik", "nik");
    }
}