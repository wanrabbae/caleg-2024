<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Saksi extends Model
{
    use HasFactory;
    protected $table = "saksi";
    protected $primaryKey = "id_saksi";
    public $timestamps = false;
    protected $guarded = [""];

    public function relawan() {
        return $this->belongsTo(Relawan::class, "id_relawan");
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
}
