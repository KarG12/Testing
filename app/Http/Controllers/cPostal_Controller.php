<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodPostales as CP;

class cPostal_Controller extends Controller
{
    public function form_cp(){
        $estados = CP::distinct('c_estado')->get();
        return view('Buscar.form_buscar',compact('estados'));
    }

}
