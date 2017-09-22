<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Ajax extends Controller
{
    public function buscarCiudades($id)
    {           
      	$cities = DB::table('municipios')->where('id_provincia', '=', $id)->get();
        return $cities;       
    }
    
}
