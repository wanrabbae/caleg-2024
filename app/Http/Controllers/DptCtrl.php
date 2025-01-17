<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Rk_pemilih;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class DptCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
        $data = Rk_pemilih::where('nik', request("nik"))->with('desa.kecamatan.kabupaten.provinsi')->first();
        if(!$data){
            return response()->json(['message' => 0]);
        }
        return response()->json(['message' => 1, 'data_dpt' => $data], 200);
    }

    // public function callRegion(Request $request)
    // {
    //     $id_desa = Desa::find(request("id_desa"));

    //     return response()->json(Desa::with("kecamatan.kabupaten")->where("id_desa", $id_desa->id_desa)->get(), 200);
    // }
}
