<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring_Saksi extends Model
{
    use HasFactory;

    protected $table = "detail_suara";
    protected $primaryKey = "id_detail";
    public $timestamps = false; 
    protected $guarded = [""];

    // protected $with = ["desa", "caleg", "partai"];
    
    public function scopeSearch($query, $search) {
        return $query->where("suara_caleg", "LIKE", "%$search%")
        ->orWhere("suara_partai", "LIKE", "%$search%")
        ->orWhereHas("desa.kecamatan.kabupaten.provinsi", function($desa) use ($search) {
            $desa->where("nama_desa", "LIKE", "%$search%")->orWhere("nama_kecamatan", "LIKE", "%$search%")->orWhere("nama_kabupaten", "LIKE", "%$search%")->orWhere("nama_provinsi", "LIKE", "%$search%");
        })
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhereHas("partai", function($partai) use ($search) {
            $partai->where("nama_partai", "LIKE", "%$search%");
        });
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function caleg()
    {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }

    public function partai()
    {
        return $this->belongsTo(Partai::class, 'id_partai');
    }

}
