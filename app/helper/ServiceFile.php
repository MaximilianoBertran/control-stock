<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 31/1/2018
 * Time: 6:06 PM
 */

namespace App\helper;


use Encuentro\User;
use Illuminate\Support\Facades\Storage;
use App\Models\ConfiguracionPlataformaCliente;
use App\Models\TipoConfiguracion;


class ServiceFile
{

    public function getSlider($sliderNumber, $fileName, $isMobile = false)
    {
        return ServiceFile::getClienteFileSlider('SLIDERS', $sliderNumber, $fileName, $isMobile);
    }

    private function getClienteFileSlider($pathPart, $number, $fileName, $isMobile = false){
        $user = \Auth::user();
        $clienteId = $user->cliente_id;
        $storagePath = 'CLIENTE_' . $clienteId . '/CONFIGURACION/'. $pathPart . '/' . $number . '/' . ($isMobile ? "MOBILE" : "PC") . "/". $fileName;
        
        $file = null;
        if(Storage::exists($storagePath)){
            $file = Storage::get($storagePath);
        }
        
        return $file;
    }
    
    public static function get($path){
        
        if(Storage::exists($path)){
            return Storage::get($path);
        }
        
        return null;

    }

}