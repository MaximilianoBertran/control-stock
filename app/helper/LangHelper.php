<?php

namespace App\helper;
use Session;
use Illuminate\Support\Facades\URL;


class LangHelper {
    
   
    public static function getJSShowHideDivsByLang(){
        
        $script = '$( document ).ready(function() {
           
                ';
        
        foreach(array_keys(config('locale.languages')) as $idioma){
            
            if($idioma != session()->get('locale')){
                $script .= ' $(".lang-'. $idioma .'").hide();';
            }
            
        }
        
            
        
        $script .= '
                    });';
        
        
        
        return $script;
    }

    public static function getJSShowHideDivsByLangExe(){
        
        $script = '';
        
        foreach(array_keys(config('locale.languages')) as $idioma){
            
            if($idioma != session()->get('locale')){
                $script .= ' $(".lang-'. $idioma .'").hide();';
            }
            
        }
        
            
        
        $script .= '';
        
        
        
        return $script;
    }
    
    public static function getTraductionFromClaveValor($originalText, $forceOneLine = false){
        
        $traducciones = trim($originalText);
        
        if(strpos($traducciones, "es:") === false || strpos(URL::current(), "backend") !== false){
            if($forceOneLine){
                return str_replace(PHP_EOL, " ", $originalText);
            }else{
                return $originalText;
            }
        }
        
        $idiomas = \Auth::user()->idiomas;
        
        $strForSplit = "###===##";
        
        foreach($idiomas as $i){
            $traducciones = str_replace($i . ":", $strForSplit . $i . ":", $traducciones);
        }
        
        $aux = explode($strForSplit, $traducciones);
        
        $trads = array();
        
        foreach ($aux as $a){
            if(trim($a) != ""){
                $auxi = explode(":", $a);
                $trads[trim($auxi[0])] = trim($auxi[1]);
            }
        }
        
        $user_idioma = \Auth::user()->idioma;
        
        if(isset($trads[$user_idioma])){
            return $trads[$user_idioma];
        }else{
            return $originalText;
        }    
        
    }
    
}