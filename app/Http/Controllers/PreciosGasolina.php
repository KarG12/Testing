<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodPostales as CP;//Importar el modelo de Codigo Postales
use Illuminate\Support\Facades\Http; //importar cliente HTTP

class PreciosGasolina extends Controller
{
    public function show_precios(Request $req){

        $response = Http::get('https://api.datos.gob.mx/v1/precio.gasolina.publico');//Consumir la Api de los precios de gasolina
        $precios = $response->json();//Convertir los datos obtenidos a JSON para su lectura
        
        $c_estado = $req->input('estado');
        $c_mnpio = $req->input('municipio');
        $order = $req->input('order');
    
        // if(!empty($c_estado)){
            /*
                Se realiza la consulta para obtener los datos por estado y/o municipio
            */
            $CodigosPostales = CP::orWhere('c_estado',$c_estado)
                            ->orWhere('c_mnpio',$c_mnpio)
                            ->get();

            $array1 = array();
            $array2 = array();
            /*
                Recorremos los dos arreglos (codigos postales y precios)
            */
            $preciosArray = $precios['results'];//Se toma el Arreglo "results" de nuestro arreglo Precios
            foreach($CodigosPostales as $codigo){
                foreach($preciosArray as $precio){
                    
                    if($codigo->d_codigo == $precio['codigopostal']){
                        $array1['id'] = $precio['_id'];
                        $array1['rfc'] = $precio['rfc'];
                        $array1['razonsocial'] = $precio['razonsocial'];
                        $array1['date_insert'] = $precio['date_insert'];
                        $array1['numeropermiso'] = $precio['numeropermiso'];
                        $array1['fechaaplicacion'] = $precio['fechaaplicacion'];
                        $array1['ufeffpermisoid'] = empty($precio['permisoid'])?"":$precio['permisoid'];
                        $array1['longitude'] = $precio['longitude'];
                        $array1['latitude'] = $precio['latitude'];
                        $array1['codigopostal'] = $precio['codigopostal'];
                        $array1['calle'] = $precio['calle'];
                        $array1['colonia'] = $precio['colonia'];
                        $array1['municipio'] = $codigo->D_mnpio;;
                        $array1['estado'] = $codigo->d_estado;
                        $array1['regular'] = $precio['regular'];
                        $array1['premium'] = $precio['premium'];
                        $array1['dieasel'] = $precio['dieasel'];
                        array_push($array2,$array1);
                    }

                }
            }

            if(!empty($array2)){
                if(!empty($order)){
                    
                    // $conPrecios = array_filter(
                    //     $array2,
                    //     function ($e) use($order) {
                    //         return $e['premium'] == $order;
                    //     }
                    // );

                    $conPrecios = $this->searchByValue($order,$array2);//Se llama la funcion para traer los valores de acuerdo al ordenamiento
                    if(!empty($conPrecios)){
                        $result = json_encode(array(
                            'success'=>true,
                            'results'=>$conPrecios
                        ));
                    }else{
                        $result = json_encode(array(
                            'success'=>false,
                            'results'=>"No se encontraron resultados para ese filtro de busqueda 1"
                        ));                        
                    }
                }else{
                    $result = json_encode(array(
                        'success'=>true,
                        'results'=>$array2
                    ));
                }
            }else{
                $result = json_encode(array(
                    'success'=>false,
                    'results'=>"No se encontraron resultados para ese filtro de busqueda 2"
                ));
            }
        return $result;
    }

    function searchByValue($id, $array) {//Funcion para traer los las gasolineras con forme a los precios capturados
        foreach ($array as $key => $val) {
            if ($val['regular'] == $id || $val['premium'] == $id || $val['dieasel'] == $id ) {
              $array1['id'] = $val['id'];
              $array1['rfc'] = $val['rfc'];
              $array1['razonsocial'] = $val['razonsocial'];
              $array1['date_insert'] = $val['date_insert'];
              $array1['numeropermiso'] = $val['numeropermiso'];
              $array1['fechaaplicacion'] = $val['fechaaplicacion'];
              $array1['ufeffpermisoid'] = empty($val['ufeffpermisoid'])?"":$val['ufeffpermisoid'];
              $array1['longitude'] = $val['longitude'];
              $array1['latitude'] = $val['latitude'];
              $array1['codigopostal'] = $val['codigopostal'];
              $array1['calle'] = $val['calle'];
              $array1['colonia'] = $val['colonia'];
              $array1['municipio'] = $val['municipio'];
              $array1['estado'] = $val['estado'];
              $array1['regular'] = $val['regular'];
              $array1['premium'] = $val['premium'];
              $array1['dieasel'] = $val['dieasel'];
              return $array1;
            }
        }
        return null;
     }
}
