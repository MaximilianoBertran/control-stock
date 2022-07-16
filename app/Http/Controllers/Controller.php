<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function selectList($list, $null=false, $emptyText="Seleccione..."){
        // recibe una lista para combo y le agrega la opcion vacia
        
        if($null){
           $ret[null] = $emptyText;
        }else{
           $ret["0"] = $emptyText; 
        }
        
        foreach($list as $clave => $valor){
            $ret[$clave] = $valor;
        }
        
        return $ret;
    }
}
