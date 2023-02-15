<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class IndoRegionController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        // $regencies = Regency::all();
        // $districts = District::all();
        // $villages = Village::all();

        return view('view_indoregion', compact('provinces'));
    }

    public function getkabupaten(Request $request)
    {
        $id_provinsi = $request->id_provinsi;

        //get Data kabupaten
        $kabupaten = Regency::where('province_id', $id_provinsi)->get();

        $option = "<option>--Pilih Kabupaten--</option>";
        //lakukan perulangan karena 1 provinsi mempunyai banyak kabupaten
        foreach ($kabupaten as $kab) {
            $option .= "<option value='$kab->id'>$kab->name</option>";
        }
        echo $option;
    }
    public function getkecamatan(Request $request)
    {
        $id_kabupaten = $request->id_kabupaten;

        //get Data kecamatan    
        $kecamatan = District::where('regency_id', $id_kabupaten)->get();

        $option = "<option>--Pilih Kecamatan--</option>";
        //lakukan perulangan karena 1 provinsi mempunyai banyak kabupaten
        foreach ($kecamatan as $kec) {
            $option .= "<option value='$kec->id'>$kec->name</option>";
        }
        return $option;
    }
    public function getdesa(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;

        //get Data Desa
        $desa = Village::where('district_id', $id_kecamatan)->get();

        $option = "<option>--Pilih Desa--</option>";
        //lakukan perulangan karena 1 provinsi mempunyai banyak kabupaten
        foreach ($desa as $ds) {
            $option .= "<option value='$ds->id'>$ds->name</option>";
        }

        return $option;
    }
}
